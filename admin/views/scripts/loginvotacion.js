
function init(){

	limpiar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
}

function limpiar()
{
	$("#dni").val("");
	$("#btnGuardar").prop("disabled",false);

}



function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "admin/controllers/loginvotacion.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos){  

	    	if (datos==1) {
					swal("¡Error!","Voto ya realizado","error");
				}else if(datos==2){
					swal("¡Error!","DNI y/o clave ingresado incorrecto","error");
				}else if(datos==3){
					swal("¡Error!","Fecha no establecida","error");
				}else if(datos==4){
					swal("¡Error!","Votación inactiva, espere la fecha de apertura","error");
				}else if(datos==5){
					swal("¡Error!","Fecha de votación expirada","error");
				}else if(datos==6){
					$(location).attr("href","listar.php");
				}else{
					swal("¡Error!","Ingrese DNI y/o calve","error");
				}
	    }

	});
	limpiar();
}


function confirvoto(idagrupacion,idpersona,lista)
{
	swal({
		title: 'Advertencia?',
		text: "¿Está seguro de votar por la lista "+lista + "?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("admin/controllers/loginvotacion.php?op=confirvoto", {idagrupacion : idagrupacion,idpersona : idpersona}, function(e){						        		
				$(location).attr("href","admin/controllers/loginvotacion.php?op=salir");
			});
		}
	})
}

init();