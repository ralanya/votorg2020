var tabla;

function init() {
    autocomplet_p();
    autocomplet_s();
    autocomplet_v();
    listar();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
    $.post("../controllers/rpt_votos.php?op=selectmesa", function(r) {
        $("#mesa").html(r);
        
    });
    $('#checkall').change(function() {
        $('.checkitem').prop("checked", $(this).prop("checked"))
    });

    $('#mconfiguracion').addClass("active pcoded-trigger");
    $('#lacta_electoral').addClass("active");   

    $("#item-menu").html('<a href="#">configuraciones</a>');
    $("#item-submenu").html('<a href="actaelectoral.php">Acta Electoral</a>');
}

function limpiar() {
    $("#idactaelectoral").val("");
    $("#fecha").val("");
    $("#horainicio").val("");
    $("#horafin").val("00:00");
    $("#horafin").prop('readonly', true);
    $("#idpersonap").val("");
    $("#idpersonas").val("");
    $("#idpersonav").val("");
    $("#pnombre").val("");
    $("#snombre").val("");
    $("#vnombre").val("");
    $("#pgrado").val("");
    $("#sgrado").val("");
    $("#vgrado").val("");
    $("#pseccion").val("");
    $("#sseccion").val("");
    $("#vseccion").val("");
    $("#personeros").val("");
    $("#btnGuardar").prop("disabled", false);
}

function cancelarform() {
    limpiar();
    $("#default-Modal").modal('hide');
}

function guardaryeditar(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../controllers/actaelectoral.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            cancelarform();
            swal("Exito!", datos, "success");
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idactaelectoral) {
    $.post("../controllers/actaelectoral.php?op=mostrar", {
        idactaelectoral: idactaelectoral
    }, function(data, status) {
        data = JSON.parse(data);
        /*	mostrarform(true);
        	$("#modda").html('Modificar Datos');
        	$("#mostraractuallogo").css("display", "block");
        	$("#mostraractualfoto").css("display", "block");*/
        $("#idactaelectoral").val(data.idactaelectoral);
        $("#mesa").val(data.mesa);
        $("#fecha").val(data.fecha);
        $("#horainicio").val(data.horainicio);
        $("#horafin").val(data.horafin);
        $("#horafin").prop('readonly', false);
        $("#idpersonap").val(data.idpersonaP);
        $("#idpersonas").val(data.idpersonaS);
        $("#idpersonav").val(data.idpersonaV);
        $("#pnombre").val(data.nombrep + ' ' + data.apellidosp);
        $("#snombre").val(data.nombres + ' ' + data.apellidoss);
        $("#vnombre").val(data.nombrev + ' ' + data.apellidosv);
        $("#pgrado").val(data.grado);
        $("#sgrado").val(data.sgrado);
        $("#vgrado").val(data.vgrado);
        $("#pseccion").val(data.seccion);
        $("#sseccion").val(data.sseccion);
        $("#vseccion").val(data.vseccion);
        $("#personeros").val(data.personeros);
    })
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
            url: '../controllers/actaelectoral.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10,
    }).DataTable();
}

function autocomplet_p() {
    $("#pnombre").autocomplete({
        source: '../controllers/padron.php?op=autocompleteP',
        minLength: 1,
        select: function(event, ui) {
            event.preventDefault();
            $('#idpersonap').val(ui.item.idpersona);
            $('#pnombre').val(ui.item.nombre);
            $('#pgrado').val(ui.item.grado);
            $('#pseccion').val(ui.item.seccion);
        }
    });
    $("#pnombre").on("keydown", function(event) {
        if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
            $("#idpersonap").val("");
            $("#pnombre").val("");
            $('#pgrado').val("");
            $('#pseccion').val("");
        }
        if (event.keyCode == $.ui.keyCode.DELETE) {
            $("#pnombre").val("");
            $('#pgrado').val("");
            $('#pseccion').val("");
            $("#idpersonap").val("");
        }
    });
}

function autocomplet_s() {
    $("#snombre").autocomplete({
        source: '../controllers/padron.php?op=autocompleteP',
        minLength: 1,
        select: function(event, ui) {
            event.preventDefault();
            $('#idpersonas').val(ui.item.idpersona);
            $('#snombre').val(ui.item.nombre);
            $('#sgrado').val(ui.item.grado);
            $('#sseccion').val(ui.item.seccion);
        }
    });
    $("#snombre").on("keydown", function(event) {
        if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
            $("#idpersonas").val("");
            $("#snombre").val("");
            $('#sgrado').val("");
            $('#sseccion').val("");
        }
        if (event.keyCode == $.ui.keyCode.DELETE) {
            $("#snombre").val("");
            $('#sgrado').val("");
            $('#sseccion').val("");
            $("#idpersonas").val("");
        }
    });
}

function autocomplet_v() {
    $("#vnombre").autocomplete({
        source: '../controllers/padron.php?op=autocompleteP',
        minLength: 1,
        select: function(event, ui) {
            event.preventDefault();
            $('#idpersonav').val(ui.item.idpersona);
            $('#vnombre').val(ui.item.nombre);
            $('#vgrado').val(ui.item.grado);
            $('#vseccion').val(ui.item.seccion);
        }
    });
    $("#vnombre").on("keydown", function(event) {
        if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
            $("#idpersonav").val("");
            $("#vnombre").val("");
            $('#vgrado').val("");
            $('#vseccion').val("");
        }
        if (event.keyCode == $.ui.keyCode.DELETE) {
            $("#vnombre").val("");
            $('#vgrado').val("");
            $('#vseccion').val("");
            $("#idpersonav").val("");
        }
    });
}

function eliminarsel() {
    var id = $('.checkitem:checked').map(function() {
        return $(this).val()
    }).get().join(' ')
    swal({
        title: 'Advertencia?',
        text: "Está Seguro de eliminar los registro?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.value) {
            $.post("../controllers/actaelectoral.php?op=eliminarsel", {
                id: id
            }, function(e) {
                swal("Exito!", e, "success");
                tabla.ajax.reload();
                $("#checkall").prop('checked', false);
            });
        }
        tabla.ajax.reload();
        $("#checkall").prop('checked', false);
    })
}
init();