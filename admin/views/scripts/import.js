var tabla;

function init(){

	$("#formulario_import").on("submit",function(e)
	{
		guardar(e);	
	});
}


function clear()
{
	$("#fileimport").val("");
	$("#btnGuardarImport").prop("disabled",false);
	$('#resultados').css('display','none');

}



function cancelarImport()
{
	clear();
	$("#default-Import").modal('hide');
}

function guardar(e)
{
	e.preventDefault();
	$("#btnGuardarImport").prop("disabled",true);
	var formData = new FormData($("#formulario_import")[0]);

	$.ajax({
		url: "../controllers/importCSV.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    beforeSend : function (){					
					$('#resultados').html('<center><img src="../Resource/files/loader/ajax-loader.gif" width="30" heigh="30"></center>');					
				},
	    success: function(datos)
	    {      
	    	if (datos==1) {
	    			swal("Error!","Seleccione un archivo para importar","error");
	    	}else{
	    		swal("Exito!",datos,"success");
	    	}              
	          	          
	          tabla.ajax.reload();
	          cancelarImport();
	    }

	});
}


init();
