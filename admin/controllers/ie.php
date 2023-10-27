<?php 
require_once "../models/Ie.php";
$BDobj=new Ie();

$idie=isset($_POST["idie"])? limpiarCadena($_POST["idie"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$logo=isset($_POST["logo"])? limpiarCadena($_POST["logo"]):"";
$imagenactual=isset($_POST["imagenactual"])? limpiarCadena($_POST["imagenactual"]):"";
$anio=isset($_POST["anio"])? limpiarCadena($_POST["anio"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$provincia=isset($_POST["provincia"])? limpiarCadena($_POST["provincia"]):"";
$distrito=isset($_POST["distrito"])? limpiarCadena($_POST["distrito"]):"";

switch ($_GET["op"]){ 
	case 'guardaryeditar':


	if (!file_exists($_FILES['logo']['tmp_name']) || !is_uploaded_file($_FILES['logo']['tmp_name']))
	{
		$logoac=$_POST["imagenactual"];
	}
	else 
	{
		$ext = explode(".", $_FILES["logo"]["name"]);
		if ($_FILES['logo']['type'] == "image/jpg" || $_FILES['logo']['type'] == "image/jpeg" || $_FILES['logo']['type'] == "image/png")
		{
			$logo = round(microtime(true)) . '.' . end($ext);
			move_uploaded_file($_FILES["logo"]["tmp_name"], "../resource/files/ie/" . $logo);
		}
	}

	if ($logo!="") {
		$ruta=is_file('../resource/files/ie/'.$imagenactual);
		if ($ruta<>NULL) {
			unlink('../resource/files/ie/'.$imagenactual);
			$rspta=$BDobj->editar($idie,$nombre,$logo,$anio,$departamento,$provincia,$distrito);
			echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
		}else{
			$rspta=$BDobj->editar($idie,$nombre,$logo,$anio,$departamento,$provincia,$distrito);
			echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
		}
	}else{
		$rspta=$BDobj->update($idie,$nombre,$logoac,$anio,$departamento,$provincia,$distrito);
		echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
	}
	break; 


	case 'mostrar':
	$rspta=$BDobj->mostrar($idie);
	echo json_encode($rspta);
	break;

	case 'listar':
	$rspta = $BDobj->listar();
	$data = array();
	$i = 1;
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$i,
			"1"=>$reg->nombre,
			"2"=>"<a href='../resource/files/ie/".$reg->logo."' data-lighter>
			<img src='../resource/files/ie/".$reg->logo."' height='35px' width='35px' > </a>",
			"3"=>$reg->anio,
			"4"=>$reg->departamento,
			"5"=>$reg->provincia,
			"6"=>$reg->distrito,
			"7"=>'<a href="#"  onclick="mostrar('.$reg->idie.')"><i data-toggle="tooltip" title="Modificar" class="icofont icofont-edit-alt" style="color: rgb(0, 166, 90);"></i></a>' .
			' <a href="#" onclick="eliminar('.$reg->idie.')"><i data-toggle="tooltip" title="Eliminar" class="icofont icofont-trash" style="color: red;"></i></a>',
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