var tabla;

function init(){
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	$('#mconfiguracion').addClass("active pcoded-trigger");
    $('#lfecha_apertura').addClass("active");	
    $("#item-menu").html('<a href="#">configuraciones</a>');
    $("#item-submenu").html('<a href="apertura.php">Fecha Apertura</a>');

}


function limpiar()
{
	$("#idapertura").val("");
}


function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#default-Modal").modal('show');
		$("#btnGuardar").prop("disabled",false);
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
			"url": "../resource/assets/js/Spanish.json"
		},

		"aProcessing": true,
	    "aServerSide": true,
	    lengthChange: false,
		"ajax":
				{
					url: '../controllers/apertura.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
	}).DataTable();

	
}

function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controllers/apertura.php?op=guardaryeditar",
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
}


function mostrar(idapertura)
{
	$.post("../controllers/apertura.php?op=mostrar",{idapertura : idapertura}, function(data, status)
	{
		
		data = JSON.parse(data);	
		mostrarform(true);	
		$("#fecha_star").val(data.fecha_star);
		$("#fecha_end").val(data.fecha_end);
		$("#idapertura").val(data.idapertura);
 	})
}


function desactivar(idapertura)
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
			$.post("../controllers/apertura.php?op=desactivar", {idapertura : idapertura}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}



function activar(idapertura)
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
			$.post("../controllers/apertura.php?op=activar", {idapertura : idapertura}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}
init();