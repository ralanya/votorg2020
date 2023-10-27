var tabla;

function init() {
    listar();
    $('#mreportes').addClass("active pcoded-trigger");
    $('#lconsolidado').addClass("active");   
    $("#item-menu").html('<a href="#">Reportes</a>');
    $("#item-submenu").html('<a href="reporte_end.php">Consolidado</a>');
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
            url: '../controllers/rpt_votos.php?op=listarend',
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
    VentanaCentrada('../reportes/report_mesa_Gexcel.php?mesa=' + mesa, '', '1024', '768', 'true');
}

function report_pdf() {
    var mesa = $("#mesa").val();
    VentanaCentrada('../reportes/report_consolidado.php', '', '1024', '768', 'true');
}
init();