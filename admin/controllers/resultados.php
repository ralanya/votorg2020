<?php
require_once "../models/Resultados.php";
$BDobj=new Resultados();
$idvoto=isset($_POST["idvoto"])? limpiarCadena($_POST["idvoto"]):"";
switch ($_GET["op"]){


	case 'activar':
		$rspta=$BDobj->activar($idvoto);
 		echo $rspta ? "Voto activado" : "Registro no se puede activar";
	break;


	case 'eliminarsel':
		$myid=$_POST['id'];
		$id=str_replace(' ',',', $myid);
		$rspta=$BDobj->eliminarsel($id);
 		echo $rspta ? "Votos eliminados" : "registros no se puede eliminar";
	break;


	case 'listar_R':
	$rspta = $BDobj->listar_votosR();
	$data = array();
	$i = 1;
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$i,
			
			"1"=>($reg->condicion_voto)?'<label class="label label-success"><i class="icofont icofont-tick-mark"> </i> Voto</label>':'<label class="label label-danger"><i class="icofont icofont-close"> </i> Anulado</label>',
			"2"=>$reg->hora,
			"3"=>$reg->nombre.' '. $reg->apellidos,		
			"4"=>'<input type="checkbox"  class="checkitem" id="checkitem" value="'.$reg->idvoto.'">',
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


	case 'listar_F':
	$rspta = $BDobj->listar_votosF();
	$data = array();
	$i = 1;
	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$i,
			"1"=>$reg->nombre.' '. $reg->apellidos,
			"2"=>$reg->dni,
			"3"=>$reg->grado,
			"4"=>$reg->seccion,
			"5"=>'<label class="label label-danger"><i class="icofont icofont-error"> </i> Falta</label>'
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