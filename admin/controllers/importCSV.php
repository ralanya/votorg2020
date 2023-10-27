<?php
require_once "../models/ImportCSV.php";
$BDobj=new Import();

switch ($_GET["op"]){
	case 'guardaryeditar':
			

			$csv =isset($_POST["fileimport"])? limpiarCadena($_POST["fileimport"]):"";
			$csv = $_FILES['fileimport']['tmp_name'];


			if ($csv==null) {
				echo $rspta=1;
			} else {
				$handle = fopen($csv,'r');
				
				while ($data = fgetcsv($handle,10000,",","'")){
					$linea[]=array('nombre' =>$data[0],'apellidos' =>$data[1],'dni' =>$data[2],'grado' =>$data[3] ,'seccion' =>$data[4],'mesa' =>$data[5]);
					}

				foreach ($linea as $indice) {
					$nombre=utf8_encode($indice["nombre"]);
					$apellidos=utf8_encode($indice["apellidos"]);
					$dni=$indice["dni"];
					$grado=$indice["grado"];
					$seccion=$indice["seccion"];
					$mesa=$indice["mesa"];
					$rspta=$BDobj->insertar($nombre,$apellidos,$dni,$grado,$seccion,$mesa);
				}

					echo $rspta ? "registros importados Satisfatoriamente" : "registros no se pudieron importar";
			}
			
			

	break;
}
?> 