<?php
require_once "../models/Agrupacion.php";
$BDobj=new Agrupacion();

$idagrupacion=isset($_POST["idagrupacion"])? limpiarCadena($_POST["idagrupacion"]):"";
$lista=isset($_POST["lista"])? limpiarCadena($_POST["lista"]):"";
$alcalde=isset($_POST["alcalde"])? limpiarCadena($_POST["alcalde"]):"";
$teniente_alcalde=isset($_POST["teniente_alcalde"])? limpiarCadena($_POST["teniente_alcalde"]):"";
$regidor_ecrd=isset($_POST["regidor_ecrd"])? limpiarCadena($_POST["regidor_ecrd"]):"";
$regidor_sa=isset($_POST["regidor_sa"])? limpiarCadena($_POST["regidor_sa"]):"";
$regidor_eap=isset($_POST["regidor_eap"])? limpiarCadena($_POST["regidor_eap"]):"";
$regidor_dna=isset($_POST["regidor_dna"])? limpiarCadena($_POST["regidor_dna"]):"";
$regidor_cti=isset($_POST["regidor_cti"])? limpiarCadena($_POST["regidor_cti"]):"";

$logo=isset($_POST["logo"])? limpiarCadena($_POST["logo"]):"";
$foto=isset($_POST["foto"])? limpiarCadena($_POST["foto"]):"";
$logoactual=isset($_POST["logoactual"])? limpiarCadena($_POST["logoactual"]):"";
$fotoactual=isset($_POST["fotoactual"])? limpiarCadena($_POST["fotoactual"]):"";


 
switch ($_GET["op"]){
	case 'guardaryeditar':
	
	if (!file_exists($_FILES['logo']['tmp_name']) || !is_uploaded_file($_FILES['logo']['tmp_name']))
	{
		$logoac=$_POST["logoactual"];
	}
	else 
	{
		$extlogo = explode(".", $_FILES["logo"]["name"]);
		if ($_FILES['logo']['type'] == "image/jpg" || $_FILES['logo']['type'] == "image/jpeg" || $_FILES['logo']['type'] == "image/png"){
			$logo = (round(microtime(true))+1) . '.' . end($extlogo);
			move_uploaded_file($_FILES["logo"]["tmp_name"], "../resource/files/lista/" . $logo);
		}
	}

	if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name']))
	{
		$fotoac=$_POST["fotoactual"];
	}
	else 
	{

		$extfoto = explode(".", $_FILES["foto"]["name"]);
		if ($_FILES['foto']['type'] == "image/jpg" || $_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/png"){
			$foto = round(microtime(true)) . '.' . end($extfoto);
			move_uploaded_file($_FILES["foto"]["tmp_name"], "../resource/files/lista/" . $foto);
		}
	}

	

	$rutalogo=is_file('../resource/files/lista/'.$logoactual);
	$rutafoto=is_file('../resource/files/lista/'.$fotoactual);

	if (empty($idagrupacion)){
		$rspta=$BDobj->insertar($lista,$logo,$alcalde,$foto,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti);
		echo $rspta ? "Datos registrados" : "No se pudieron registrar  los datos del usuario";
	}else {
		if ($logo!=0 and $foto==0 ) {
			if ($rutalogo<>NULL) {
				unlink('../resource/files/lista/'.$logoactual);
				$rspta=$BDobj->editar($idagrupacion,$lista,$logo,$alcalde,$fotoactual,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti);
				echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
			}else{
				$rspta=$BDobj->editar($idagrupacion,$lista,$logo,$alcalde,$fotoactual,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti);
				echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
			}
		}elseif ($foto!=0 and $logo==0) {
			if ($rutafoto<>NULL) {
				unlink('../resource/files/lista/'.$fotoactual);
				$rspta=$BDobj->editar($idagrupacion,$lista,$logoactual,$alcalde,$foto,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti);
				echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
			}else{
				$rspta=$BDobj->editar($idagrupacion,$lista,$logoactual,$alcalde,$foto,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti);
				echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
			}
		}elseif ($logo==0 and $foto==0) {
			if ($rutafoto<>NULL and $rutafoto<>NULL) {
				$rspta=$BDobj->editar($idagrupacion,$lista,$logoactual,$alcalde,$fotoactual,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti);
				echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
			}else{
				
				$rspta=$BDobj->editar($idagrupacion,$lista,$logoactual,$alcalde,$fotoactual,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti);
				echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
			}
		}else{
			unlink('../resource/files/lista/'.$fotoactual);
			unlink('../resource/files/lista/'.$logoactual);
			$rspta=$BDobj->update($idagrupacion,$lista,$logo,$alcalde,$foto,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti);
			echo $rspta ? "registro actualizado" : "registro no se pudo actualizar";
		}

	}
	break;

	case 'desactivar':
		$rspta=$BDobj->desactivar($idagrupacion);
 		echo $rspta ? "Lista Desactivada" : "Lista no se puede desactivar";
	break;
 
	case 'activar':
		$rspta=$BDobj->activar($idagrupacion);
 		echo $rspta ? "Lista activada" : "Lista no se puede activar";
	break;

	case 'mostrar':
		$rspta=$BDobj->mostrar($idagrupacion);
 		echo json_encode($rspta);
	break;

	case 'listar':
	$rspta = $BDobj->listar();
	$data = array();
	$i = 1;
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=> $i,
			"1"=>$reg->lista,
			"2"=>"<a href='../Resource/files/lista/".$reg->logo."' data-lighter>
			<img src='../resource/files/lista/".$reg->logo."' height='35px' width='35px' > </a>",
			"3"=>$reg->alcalde,
			"4"=>"<a href='../Resource/files/lista/".$reg->foto."' data-lighter>
			<img src='../resource/files/lista/".$reg->foto."' height='35px' width='35px' > </a>",
			"5"=> $reg->teniente_alcalde,
			"6"=>
				' <a href="#"  onclick="listregidores(\''.$reg->regidor_ecrd.'\',\''.$reg->regidor_sa.'\',\''.$reg->regidor_eap.'\',\''.$reg->regidor_dna.'\',\''.$reg->regidor_cti.'\',\''.$reg->lista.'\')"  data-toggle="modal" data-target="#default-Regidores" style="background:#1569B8; color:white; padding:4px; border-radius:4px; "> Ver +</a>',
			"7"=>($reg->condicion)?'<span class="btn btn-success btn-mini" onclick="desactivar('.$reg->idagrupacion.')"> Activo</span>':
			'<span class="btn btn-danger btn-mini" onclick="activar('.$reg->idagrupacion.')">Inactivado</span>',
			"8"=>($reg->idagrupacion<>1)?
			' <a href="#"  onclick="mostrar('.$reg->idagrupacion.')"><i data-toggle="tooltip" title="Modificar" class="icofont icofont-edit-alt" style="color: rgb(0, 166, 90);"></i></a>' .
			' <a href="#" onclick="eliminar(' .$reg->idagrupacion.')"><i data-toggle="tooltip" title="Eliminar" class="icofont icofont-trash" style="color: red;"></i></a>':'',
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