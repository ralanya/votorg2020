var tabla;

function init() {
    listar();
    $("#mesa").change(listar);
    $.post("../controllers/rpt_votos.php?op=selectmesa", function(r) {
        $("#mesa").html(r);
        $("#mesa").select2();
    });
    $('#mreportes').addClass("active pcoded-trigger");
    $('#lpadron_mesa').addClass("active");   
    $("#item-menu").html('<a href="#">Reportes</a>');
    $("#item-submenu").html('<a href="reporte_padron.php">Padron electoral</a>');
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

function report_mesa_excel() {
    var mesa = $("#mesa").val();
    VentanaCentrada('../reportes/padron_mesa_excel.php?mesa=' + mesa, '', '1024', '768', 'true');
}
init();