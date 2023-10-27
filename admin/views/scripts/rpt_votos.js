var tabla;

function init(){

	listar();
    $('#mresultados').addClass("active pcoded-trigger");

}


function listar()
{
	tabla=$('#tbllistado').dataTable({
		language: {
			"url": "../resource/assets/js/Spanish.json"
		},
		"aProcessing": true,
	    "aServerSide": true,
	    lengthChange: false,
		"ajax":
				{
					url: '../controllers/rpt_votos.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,
			}).DataTable();
}


function report_excel()
{
	VentanaCentrada('../reportes/report_Gexcel.php','','1024','768','true'); 	

}

function report_pdf()
{
	VentanaCentrada('../reportes/report_Gpdf.php','','1024','768','true'); 	

}
init();