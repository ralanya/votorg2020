

<?php
require "../config/Conexion.php";
Class Import {

	public function __construct()
	{ 
	}


	public function insertar($nombre,$apellidos,$dni,$grado,$seccion,$mesa)
	{
		$sql="INSERT INTO persona (nombre,apellidos,dni,grado,seccion,mesa,condicion) VALUES ('$nombre','$apellidos','$dni','$grado','$seccion','$mesa','1')";
		return ejecutarConsulta($sql);
	}



}


?>