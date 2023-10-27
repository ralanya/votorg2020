var tabla_r;
var tabla_f;

function init(){

	listar_R();
	listar_F();

	$('#checkall').change(function() {
   	 $('.checkitem').prop("checked",$(this).prop("checked"))
	});

    $('#mvotos').addClass("active pcoded-trigger");
    $('#lvotos').addClass("active");   

    $("#item-menu").html('<a href="#">votos</a>');
    $("#item-submenu").html('<a href="resultados.php">listado</a>');

}




function listar_R()
{
	tabla_r=$('#tbllistado_r').dataTable({
		language: {
			"url": "../resource/assets/js/Spanish.json"
		},
		"aProcessing": true,
	    "aServerSide": true,
	    lengthChange: false,
		"ajax":
				{
					url: '../controllers/resultados.php?op=listar_R',
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

function listar_F()
{
	tabla_f=$('#tbllistado_f').dataTable({
		language: {
			"url": "../resource/assets/js/Spanish.json"
		},
		"aProcessing": true,
	    "aServerSide": true,
	    lengthChange: false,
		"ajax":
				{
					url: '../controllers/resultados.php?op=listar_F',
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


function eliminarsel()
{
	var id = $('.checkitem:checked').map(function(){
		return $(this).val()
	}).get().join(' ')
	swal({
		title: 'Advertencia?',
		text: "Está Seguro de eliminar los registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("../Controllers/resultados.php?op=eliminarsel",{id : id}, function(e){						        		
				swal("Exito!",e,"success");	

				tabla_r.ajax.reload();
				tabla_f.ajax.reload();
				$("#checkall").prop('checked',false);
			});
		}
		tabla_r.ajax.reload();
		$("#checkall").prop('checked',false);
	})
}


function activar(idvoto)
{
	swal({
		title: 'Advertencia?',
		text: "Está Seguro de activar este voto?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("../controllers/resultados.php?op=activar", {idvoto : idvoto}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla_r.ajax.reload();
			});
		}
		tabla_r.ajax.reload();
	})
}

init();