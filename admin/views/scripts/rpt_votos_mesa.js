var tabla;

function init() {
    listar();
    $("#mesa").change(listar);
    $.post("../controllers/rpt_votos.php?op=selectmesa_acta", function(r) {
        $("#mesa").html(r);
        $("#mesa").select2();
    });

    $('#mreportes').addClass("active pcoded-trigger");
    $('#lmesa').addClass("active");   
    $("#item-menu").html('<a href="#">Reportes</a>');
    $("#item-submenu").html('<a href="reporte_mesa.php">Mesa</a>');
}

function listar() {
    var mesa = $("#mesa").val();
    tabla = $('#tbllistado').dataTable({
        language: {
            "url": "../resource/assets/js/Spanish.json"
        },
        "aProcessing": true,
        "aServerSide": true,
        lengthChange: false,
        "ajax": {
            url: '../controllers/rpt_votos.php?op=listarmesa',
            data: {
                mesa: mesa
            },
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

function report_mesa_pdf() {
    var mesa = $("#mesa").val();
    VentanaCentrada('../reportes/Acta_electoral.php?mesa=' + mesa, '', '1024', '768', 'true');
}
init();