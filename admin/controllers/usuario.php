<?php
session_start(); 
require_once "../models/Usuario.php";
$BDobj=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

	if (empty($idusuario)){
		$rspta=$BDobj->insertar($nombre,$apellidos,$login,$clave);
		echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
	}
	else {
		$rspta=$BDobj->editar($idusuario,$nombre,$apellidos,$login,$clave);
		echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
	}
	break;

	case 'desactivar':
	$rspta=$BDobj->desactivar($idusuario);
	echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;
	
	case 'activar':
	$rspta=$BDobj->activar($idusuario);
	echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;

	case 'mostrar':
	$rspta=$BDobj->mostrar($idusuario);
	echo json_encode($rspta);
	break;

	case 'listar':
	$rspta = $BDobj->listar();
	$data = array();
	$i = 1;
	while ($reg=$rspta->fetch_object()){
		$data[]=array(

			"0"=> $i,
			"1"=> $reg->nombre,
			"2"=> $reg->apellidos,
			"3"=> $reg->login,
			"4"=>($reg->condicion=='1' and $reg->login=='admin')?'<span class="btn btn-success btn-mini">activo</span>'
			:(($reg->condicion=='1' and $reg->login<>'admin')?'<span class="btn btn-success btn-mini" disabled onclick="desactivar('.$reg->idusuario.')"> Activo</span>':'<span class="btn btn-danger btn-mini" onclick="activar('.$reg->idusuario.')">Inactivado</span>'),

			"5"=>($reg->login=='admin')?
			' <a href="#"   onclick="mostrar('.$reg->idusuario.')"><i data-toggle="tooltip" title="Modificar" class="icofont icofont-edit-alt"" style="color: rgb(0, 166, 90);"></i></a>': ' <a href="#"  onclick="mostrar('.$reg->idusuario.')"><i data-toggle="tooltip" title="Modificar" class="icofont icofont-edit-alt"" style="color: rgb(0, 166, 90);"></i></a>'.
			' <a href="#" onclick="eliminar(' .$reg->idusuario.')"><i data-toggle="tooltip" title="Eliminar" class="icofont icofont-trash" style="color: red;"></i></a>',
		);
		$i++;
	}
	$results = array(
		"sEcho"=>1, 
		"iTotalRecords"=>count($data), 
		"iTotalDisplayRecords"=>count($data), 
		"aaData"=>$data);
	echo json_encode($results);


	break;

	case 'verificar':
	$logina=$_POST['logina'];
	$clavea=$_POST['clavea'];


	$rspta=$BDobj->verificar($logina, $clavea);
	$fetch=$rspta->fetch_object();

	if (isset($fetch))
	{

		$_SESSION['idusuario']=$fetch->idusuario;
		$_SESSION['nombre_usuario']=$fetch->nombre.' '. $fetch->apellidos;
		$_SESSION['login']=$fetch->login;

	}
	echo json_encode($fetch);
	break;

	case 'salir':  
        session_unset();
        session_destroy();
        header("Location: ../index.php");

	break;
}
?>