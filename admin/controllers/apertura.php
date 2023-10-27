<?php

require_once "../models/Apertura.php";

$BDobj=new Apertura();

$idapertura=isset($_POST["idapertura"])? limpiarCadena($_POST["idapertura"]):"";
$fecha_star=isset($_POST["fecha_star"])? limpiarCadena($_POST["fecha_star"]):"";
$fecha_end=isset($_POST["fecha_end"])? limpiarCadena($_POST["fecha_end"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

	if ($idapertura!=0) {
		$rspta=$BDobj->editar($idapertura,$fecha_star,$fecha_end);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
	}
	break; 

	case 'desactivar':
		$rspta=$BDobj->desactivar($idapertura);
 		echo $rspta ? "Registro desactivado" : "Registro no se puede desactivar";
	break;
 
	case 'activar':
		$rspta=$BDobj->activar($idapertura);
 		echo $rspta ? "Registro activado" : "Registro no se puede activar";
	break;


	case 'mostrar':
	$rspta=$BDobj->mostrar($idapertura);
	echo json_encode($rspta);
	break;


	case 'listar':
	$rspta = $BDobj->listar();
	$data = array();
	$i = 1;
	while ($reg=$rspta->fetch_object()){
				$data[]=array(
				"0"=>$i,
				"1"=>$reg->fecha_star,
				"2"=>$reg->fecha_end,
				"3"=>($reg->condicion)?'<span class="btn btn-success btn-mini" onclick="desactivar('.$reg->idapertura.')"> Activo</span>':
								'<span class="btn btn-danger btn-mini" onclick="activar('.$reg->idapertura.')">Inactivado</span>',
				"4"=>'<a href="#"  onclick="mostrar('.$reg->idapertura.')"><i data-toggle="tooltip" title="Modificar" class="icofont icofont-edit-alt" style="color: rgb(0, 166, 90);"></i></a>',
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