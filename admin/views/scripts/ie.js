var tabla;

function init() {
    listar();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
    $('#mconfiguracion').addClass("active pcoded-trigger");
    $('#lIe').addClass("active");

    $("#item-menu").html('<a href="#">configuraciones</a>');
    $("#item-submenu").html('<a href="ie.php">Intitucion Educativa</a>');
}

function limpiar() {
    $("#idie").val("");
    $("#nombre").val("");
    $("#anio").val("");
    $("#logo").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#imgdv").attr("src", "");
}

function clearimg() {
    $("#logo").val("");
    $("#imgdv").attr("src", "");
}

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#default-Modal").modal('show');
        $("#btnGuardar").prop("disabled", false);
    } else {
        $("#default-Modal").modal('hide');
    }
}

function cancelarform() {
    limpiar();
    mostrarform(false);
}

function listar() {
    tabla = $('#tbllistado').dataTable({
        language: {
            "url": "../resource/assets/js/Spanish.json"
        },
        "aProcessing": true,
        "aServerSide": true,
        lengthChange: false,
        "ajax": {
            url: '../controllers/ie.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
    }).DataTable();
}

function mostrar(idie) {
    $.post("../controllers/ie.php?op=mostrar", {
        idie: idie
    }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#nombre").val(data.nombre);
        $("#anio").val(data.anio);
        $("#departamento").val(data.departamento);
        $("#provincia").val(data.provincia);
        $("#distrito").val(data.distrito);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../resource/files/ie/" + data.logo);
        $("#imagenactual").val(data.logo);
        $("#idie").val(data.idie);
    })
}

function guardaryeditar(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../controllers/ie.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            swal("Exito!", datos, "success");
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
}

function validarExt(file) {
    var filesize = file.files[0].size / 1024 / 1024;
    var archivoInput = document.getElementById('logo');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.jpg|.png|.jpeg|.gif)$/i;
    if (!extPermitidas.exec(archivoRuta)) {
        mostrarform(false);
        swal('Error!', 'Formato incorrecto', 'error');
        archivoInput.value = '';
        $("#imgdv").attr("src", "");
        return false;
    } else if (filesize > 2) {
        swal('Error!', 'El archivo excede los 2 MB', 'error');
        archivoInput.value = '';
        $("#imgdv").attr("src", "");
        return false;
    } else {
        if (archivoInput.files && archivoInput.files[0]) {
            var visor = new FileReader();
            visor.onload = function(e) {
                document.getElementById('visorArchivo').innerHTML = '<embed src="' + e.target.result + '" width="150" height="120" id="imgdv" />';
            };
            visor.readAsDataURL(archivoInput.files[0]);
            /*$("#imagenmuestra").hide();*/
        }
    }
}
init();