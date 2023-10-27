<?php
require_once "../models/Actaelectoral.php";
$BDobj=new Actaelectoral();

$idactaelectoral=isset($_POST["idactaelectoral"])? limpiarCadena($_POST["idactaelectoral"]):"";
$mesa=isset($_POST["mesa"])? limpiarCadena($_POST["mesa"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$horainicio=isset($_POST["horainicio"])? limpiarCadena($_POST["horainicio"]):"";
$horafin=isset($_POST["horafin"])? limpiarCadena($_POST["horafin"]):"";
$idpersonap=isset($_POST["idpersonap"])? limpiarCadena($_POST["idpersonap"]):"";
$idpersonas=isset($_POST["idpersonas"])? limpiarCadena($_POST["idpersonas"]):"";
$idpersonav=isset($_POST["idpersonav"])? limpiarCadena($_POST["idpersonav"]):"";
$personeros=isset($_POST["personeros"])? limpiarCadena($_POST["personeros"]):"";
 
switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idactaelectoral)){
			$rspta=$BDobj->insertar($mesa,$fecha,$horainicio,$horafin,$idpersonap,$idpersonas,$idpersonav,$personeros);
			echo $rspta ? "Datos registrados" : "No se pudieron registrar los datos";
		}else {
				$rspta=$BDobj->editar($idactaelectoral,$mesa,$fecha,$horainicio,$horafin,$idpersonap,$idpersonas,$idpersonav,$personeros);
				echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
			}
		
	break;

	case 'eliminarsel':
		$myid=$_POST['id'];
		$id=str_replace(' ',',', $myid);
		$rspta=$BDobj->eliminarsel($id);
 		echo $rspta ? "Registros eliminados" : "registros no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$BDobj->mostrar($idactaelectoral);
 		echo json_encode($rspta);
	break;



	case 'listar':
	$rspta = $BDobj->listar();
	$data = array();
	$i = 1;
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>'N° '.$reg->mesa,
			"1"=>$reg->fecha,
			"2"=>$reg->horainicio,
			"3"=>$reg->horafin,
			"4"=>$reg->nombrep.' '.$reg->apellidosp,
			"5"=>$reg->nombres.' '.$reg->apellidoss,
			"6"=>$reg->nombrev.' '.$reg->apellidosv,
			"7"=>$reg->personeros,
			"8"=>
			' <input type="checkbox"  class="checkitem" id="checkitem" value="'. $reg->idactaelectoral.'">'.
			' <a href="#" data-toggle="modal" data-target="#default-Modal"  onclick="mostrar('.$reg->idactaelectoral.')"><i data-toggle="tooltip" title="Modificar" class="icofont icofont-edit-alt" style="color: rgb(0, 166, 90);"></i></a>',
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

}
?>