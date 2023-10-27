var tabla;

function init(){

	listar();

	$("#j-pro").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	$('#checkall').change(function() {
    $('.checkitem').prop("checked",$(this).prop("checked"))
    });

    $('#mpadron').addClass("active pcoded-trigger");
    $('#lpadron').addClass("active");	
    $("#item-menu").html('<a href="#">Padron Electoral</a>');
    $("#item-submenu").html('<a href="padron.php">Listado</a>');

}


function limpiar()
{

	$("#idpersona").val("");
	$("#nombre").val("");
	$("#apellidos").val("");
	$("#dni").val("");
	$("#grado").val("");
	$("#seccion").val("");
	$("#mesa").val("");

	$("#btnGuardar").prop("disabled",false);
}

function cancelarform()
{
	limpiar();
	$("#default-Modal").modal('hide');

}


function listar()
{
	tabla=$('#tbllistado').dataTable({
	/*	responsive: true,*/
		language: {
			"url": "../resource/assets/js/Spanish.json"
		},
		"aProcessing": true,
	    "aServerSide": true,
	    lengthChange: false,
		"ajax":
				{
					url: '../controllers/padron.php?op=listar',
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



function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#j-pro")[0]);

	$.ajax({
		url: "../controllers/padron.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal("Exito!",datos,"success");	          
	          tabla.ajax.reload();
	          cancelarform();
	    }

	});
	limpiar();
}

function mostrar(idpersona)
{
	$.post("../controllers/padron.php?op=mostrar",{idpersona : idpersona}, function(data, status)
	{
	data = JSON.parse(data);		
	$("#modda").html('Modificar Datos');
	$("#idpersona").val(data.idpersona);
	$("#nombre").val(data.nombre);
	$("#apellidos").val(data.apellidos);
	$("#dni").val(data.dni);
	$("#grado").val(data.grado);
	$("#seccion").val(data.seccion);
	$("#mesa").val(data.mesa);
 	})
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
								 $.post("../controllers/padron.php?op=eliminarsel",{id : id}, function(e){						        		
									swal("Exito!",e,"success");	
									tabla.ajax.reload();
									$("#checkall").prop('checked',false);
								});
							}
							tabla.ajax.reload();
							$("#checkall").prop('checked',false);
						})
}


function desactivar(idpersona)
{
	swal({
		title: 'Advertencia?',
		text: "Está Seguro de desactivar este registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("../controllers/padron.php?op=desactivar", {idpersona : idpersona}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}



function activar(idpersona)
{
	swal({
		title: 'Advertencia?',
		text: "Está Seguro de activar este registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("../controllers/padron.php?op=activar", {idpersona : idpersona}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}



 function validarExt(file)
{

  var archivoInput = document.getElementById('fileimport');
  var archivoRuta = archivoInput.value;
  var extPermitidas = /(.csv|.CSV)$/i;

  if(!extPermitidas.exec(archivoRuta)){
  	$("#default-Import").modal('hide');
    swal('Error!','Formato incorrecto','error') ; 
    archivoInput.value = '';
    return false;

  }
}
init();