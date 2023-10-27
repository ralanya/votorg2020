<?php 
session_start(); 
date_default_timezone_set('America/Lima');
require_once "../models/Loginvotacion.php";
$BDobj=new Loginvotacion();

$dni=isset($_POST["dni"])? limpiarCadena($_POST["dni"]):"";
$fecha_actual=date("Y-m-d");
$hora = date('h:i:s');

switch ($_GET["op"]){

	case 'guardaryeditar':

	if ($dni==0) {
		$rspta=0;
	}else{

		$rspta=$BDobj->listarvoto($dni);
		$fetch=$rspta->fetch_object();

		if (isset($fetch)){
			echo $rspta=1;	
			
		}else{
			$rspta_persona=$BDobj->listarpersona($dni);
			$row_persona=$rspta_persona->fetch_object();

			if (isset($row_persona)) {

				$rspta_apertura=$BDobj->listarapertura();
				$row_apertura=$rspta_apertura->fetch_object();
				$fecha_star=$row_apertura->fecha_star;
				$fecha_end=$row_apertura->fecha_end;
				$condicion_apertura=$row_apertura->condicion;

				if ($condicion_apertura==1) {
					if ($fecha_actual>=$fecha_star and $fecha_actual<=$fecha_end) {
						$_SESSION['idpersona']=$row_persona->idpersona;
						$_SESSION['nombre']=$row_persona->nombre;
						$_SESSION['apellidos']=$row_persona->apellidos;
						$_SESSION['dni']=$row_persona->dni;
						echo $rspta=6;
					}else if($fecha_actual<$fecha_star) {
						echo $rspta=4;
					}else if($fecha_actual>$fecha_end){
						echo $rspta=5;
					}

				}else{
					echo $rspta=3;
				}
				
			} else {
				echo $rspta=2;	
			}
		}
	}


	break; 

	case 'confirvoto': 
			$idagrupacion=$_POST['idagrupacion'];
			$idpersona=$_POST['idpersona'];

            $rspta=$BDobj->confirvoto($idagrupacion,$idpersona,$fecha_actual,$hora);
			echo $rspta ? "voto realizado satisfactoriamente" : "voto no realizado ";

	break;

	// case 'salir':  
 //        session_unset();
 //        session_destroy();
 //        header("Location: ../../index.php");

	// break;

}
?>
