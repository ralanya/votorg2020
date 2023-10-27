var tabla;

function init(){

	listar();
	
	$("#mostraractuallogo").css("display", "none");
	$("#mostraractualfoto").css("display", "none");
	$("#verticle-wizard").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	$('#magrupacion').addClass("active pcoded-trigger");
	$("#item-menu").html('<a href="#">Listas</a>');
    $("#item-submenu").html('<a href="agrupacion.php">Agrupacion</a>');
}


function limpiar()
{
	$("#mostraractuallogo").css("display", "none");
	$("#mostraractualfoto").css("display", "none");
	$("#idagrupacion").val("");
	$("#lista").val("");
	$("#alcalde").val("");
	$("#teniente_alcalde").val("");
	$("#regidor_ecrd").val("");
	$("#regidor_sa").val("");
	$("#regidor_eap").val("");
	$("#regidor_dna").val("");
	$("#regidor_cti").val("");

	$("#logo").val("");
	$("#logomuestra").attr("src","");
	$("#logoactual").val("");
	$("#imglogo").attr("src","");

	$("#foto").val("");
	$("#fotomuestra").attr("src","");
	$("#fotoactual").val("");
	$("#imgfoto").attr("src","");
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
		$("#modda").html('Agregar Datos');
	}
}


function cancelarform()
{
	limpiar();
	mostrarform(false);
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
					url: '../controllers/agrupacion.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
			}).DataTable();


}

function listregidores(regidor_ecrd,regidor_sa,regidor_eap,regidor_dna,regidor_cti,lista)
{
	$("#reg1").html(regidor_ecrd);
	$("#reg2").html(regidor_sa);
	$("#reg3").html(regidor_eap);
	$("#reg4").html(regidor_dna);
	$("#reg5").html(regidor_cti);
	$("#titulo").html(lista);

}


function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#verticle-wizard")[0]);

	$.ajax({
		url: "../controllers/agrupacion.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal("Exito!",datos,"success");	          
	          mostrarform(false);
	          tabla.ajax.reload();
	          console.log(datos);
	    }

	});
	limpiar();
}

function mostrar(idagrupacion)
{
	$.post("../controllers/agrupacion.php?op=mostrar",{idagrupacion : idagrupacion}, function(data, status)
	{
	data = JSON.parse(data);		
	mostrarform(true);
	$("#modda").html('Modificar Datos');
	$("#mostraractuallogo").css("display", "block");
	$("#mostraractualfoto").css("display", "block");
	
	$("#idagrupacion").val(data.idagrupacion);
	$("#lista").val(data.lista);
	$("#alcalde").val(data.alcalde);
	$("#teniente_alcalde").val(data.teniente_alcalde);
	$("#regidor_ecrd").val(data.regidor_ecrd);
	$("#regidor_sa").val(data.regidor_sa);
	$("#regidor_eap").val(data.regidor_eap);
	$("#regidor_dna").val(data.regidor_dna);
	$("#regidor_cti").val(data.regidor_cti);

	$("#logomuestra").show();
	$("#logomuestra").attr("src","../resource/files/lista/"+data.logo);
	$("#logoactual").val(data.logo);

	$("#fotomuestra").show();
	$("#fotomuestra").attr("src","../resource/files/lista/"+data.foto);
	$("#fotoactual").val(data.foto);
 	})
}



function eliminar(idagrupacion)
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
			$.post("../controllers/agrupacion.php?op=eliminar", {idagrupacion : idagrupacion}, function(e){							        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}


function desactivar(idagrupacion)
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
			$.post("../controllers/agrupacion.php?op=desactivar", {idagrupacion : idagrupacion}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}



function activar(idagrupacion)
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
			$.post("../controllers/agrupacion.php?op=activar", {idagrupacion : idagrupacion}, function(e){						        		
				swal("Exito!",e,"success");	
				tabla.ajax.reload();
			});
		}
		tabla.ajax.reload();
	})
}

function validarlogo(file)
{

	var filesize=file.files[0].size/1024/1024;
	var archivoInput = document.getElementById('logo');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.jpg|.png|.jpeg|.gif)$/i;

	if(!extPermitidas.exec(archivoRuta)){
		mostrarform(false);
		swal('Error!','Formato incorrecto','error') ; 
		archivoInput.value = '';
		$("#imglogo").attr("src","");
		return false;
	} else if (filesize>2) {
		swal('Error!','El archivo excede los 2 MB','error') ; 
		archivoInput.value = '';
		$("#imglogo").attr("src","");
		return false;
	}else{
        if (archivoInput.files && archivoInput.files[0]) 
        {
        	var visor = new FileReader();
        	visor.onload = function(e) 
        	{
        		document.getElementById('vistalogo').innerHTML = 
        		'<embed src="'+e.target.result+'" width="150" height="120" id="imglogo" />';
        	};
        	visor.readAsDataURL(archivoInput.files[0]);
        }
    }
}

function clearlogo()
{
	$("#logo").val("");
	$("#imglogo").attr("src","");
}

function validarfoto(file)
{

	var filesize=file.files[0].size/1024/1024;
	var archivoInput = document.getElementById('foto');
	var archivoRuta = archivoInput.value;
	var extPermitidas = /(.jpg|.png|.jpeg|.gif)$/i;

	if(!extPermitidas.exec(archivoRuta)){
		mostrarform(false);
		swal('Error!','Formato incorrecto','error') ; 
		archivoInput.value = '';
		$("#imgfoto").attr("src","");
		return false;
	} else if (filesize>2) {
		swal('Error!','El archivo excede los 2 MB','error') ; 
		archivoInput.value = '';
		$("#imgfoto").attr("src","");
		return false;
	}else{
        if (archivoInput.files && archivoInput.files[0]) 
        {
        	var visor = new FileReader();
        	visor.onload = function(e) 
        	{
        		document.getElementById('vistafoto').innerHTML = 
        		'<embed src="'+e.target.result+'" width="150" height="120" id="imgfoto" />';
        	};
        	visor.readAsDataURL(archivoInput.files[0]);
        }
    }
}

function clearfoto()
{
	$("#foto").val("");
	$("#imgfoto").attr("src","");
}

init();