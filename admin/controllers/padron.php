<?php
require_once "../models/Padron.php";
$BDobj=new Persona();

$idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$dni=isset($_POST["dni"])? limpiarCadena($_POST["dni"]):"";
$grado=isset($_POST["grado"])? limpiarCadena($_POST["grado"]):"";
$seccion=isset($_POST["seccion"])? limpiarCadena($_POST["seccion"]):"";
$mesa=isset($_POST["mesa"])? limpiarCadena($_POST["mesa"]):"";
 
switch ($_GET["op"]){
	case 'guardaryeditar':


		if (empty($idpersona)){
			$rspta=$BDobj->insertar($nombre,$apellidos,$dni,$grado,$seccion,$mesa);
			echo $rspta ? "Datos registrados" : "No se pudieron registrar todos los datos del usuario";
		}else {
				$rspta=$BDobj->editar($idpersona,$nombre,$apellidos,$dni,$grado,$seccion,$mesa);
				echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
			}
		
	break;

	case 'eliminarsel':
		$myid=$_POST['id'];
		$id=str_replace(' ',',', $myid);
		$rspta=$BDobj->eliminarsel($id);
 		echo $rspta ? "Registros eliminados" : "registros no se puede eliminar";
	break;

	case 'desactivar':
		$rspta=$BDobj->desactivar($idpersona);
 		echo $rspta ? "Registro desactivado" : "Registro no se puede desactivar";
	break;
 
	case 'activar':
		$rspta=$BDobj->activar($idpersona);
 		echo $rspta ? "Registro activado" : "Registro no se puede activar";
	break;

	case 'mostrar':
		$rspta=$BDobj->mostrar($idpersona);
 		echo json_encode($rspta);
	break;



	case 'listar':
	$rspta = $BDobj->listar();
	$data = array();
	$i = 1;
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$i,
			"1"=>$reg->nombre,
			"2"=>$reg->apellidos,
			"3"=>$reg->dni,
			"4"=>$reg->grado,
			"5"=>$reg->seccion,
			"6"=>($reg->condicion)?'<span class="btn btn-success btn-mini" onclick="desactivar('.$reg->idpersona.')"> Activo</span>':
			'<span class="btn btn-danger btn-mini" onclick="activar('.$reg->idpersona.')">Inactivado</span>',
			"7"=>
			' <a href="#" data-toggle="modal" data-target="#default-Modal"  onclick="mostrar('.$reg->idpersona.')"><i data-toggle="tooltip" title="Modificar" class="icofont icofont-edit-alt" style="color: rgb(0, 166, 90);"></i></a>' .
			' <input type="checkbox"  class="checkitem" id="checkitem" value="'. $reg->idpersona.'">',
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

	case 'autocompleteP':
		$searchTerm = $_GET['term'];
		$rspta = $BDobj->autocomplete($searchTerm);
		$datos = array();
		while ($reg=$rspta->fetch_object()) {
			$idpersona = $reg->idpersona;
		    $nombre = $reg->nombre;
		    $apellidos = $reg->apellidos;
		    $dni = $reg->dni;
		    $grado = $reg->grado;
		    $seccion = $reg->seccion;
		    
			$row_array['value'] =$dni." | " .$nombre." ".$apellidos;
			$row_array['idpersona']=$idpersona;
			$row_array['nombre']=$nombre." ".$apellidos;
			$row_array['grado']=$grado;
			$row_array['seccion']=$seccion;
			array_push($datos,$row_array);
		}
 		echo json_encode($datos);
	break;
}
?>