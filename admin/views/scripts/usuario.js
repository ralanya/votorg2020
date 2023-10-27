var tabla;

function init(){
	listar();

	$("#j-pro").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	$('#mconfiguracion').addClass("active pcoded-trigger");
    $('#lusuario').addClass("active");	

    $("#item-menu").html('<a href="#">configuraciones</a>');
    $("#item-submenu").html('<a href="usuario.php">Usuarios</a>');
}


function limpiar()
{
	$("#idusuario").val("");
	$("#nombre").val("");
	$("#apellidos").val("");
	$("#login").val("");
	$("#clave").val("");
	$("#btnGuardar").prop("disabled",false);
}


function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#default-Modal").modal('show');

	}
	else
	{
		$("#default-Modal").modal('hide');
	}
}


function cancelarform()
{
	limpiar();
	mostrarform(false);
}

function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		language: {
			"url": "../Resource/assets/js/Spanish.json"
		},
		"aProcessing": true,
	    "aServerSide": true,
	     lengthChange: false,
		"ajax":
				{
					url: '../controllers/usuario.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,
		"searching":false,
	}).DataTable();
}


function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#j-pro")[0]);

	$.ajax({
		url: "../Controllers/usuario.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal("Exito!",datos,"success");	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idusuario)
{
	$.post("../controllers/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status)
	{
	data = JSON.parse(data);		
	mostrarform(true);
	$("#nombre").val(data.nombre);
	$("#apellidos").val(data.apellidos);
	$("#login").val(data.login);
	$("#clave").val(data.clave);
	$("#idusuario").val(data.idusuario);
 	})
}



function eliminar(idusuario)
{
	swal({
		title: 'Advertencia?',
		text: "Está Seguro de eliminar este registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No',
		confirmButtonText: 'Si'
	}).then((result) => {
		if (result.value) {
			$.post("../controllers/usuario.php?op=eliminar", {idusuario : idusuario}, function(e){							        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}


function desactivar(idusuario)
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
			$.post("../controllers/usuario.php?op=desactivar", {idusuario : idusuario}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}



function activar(idusuario)
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
			$.post("../controllers/usuario.php?op=activar", {idusuario : idusuario}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}

init();