

<?php
require "../config/Conexion.php";
Class Loginvotacion {

	public function __construct()
	{ 
	}

	public function listarvoto($dni)
	{
		$sql="SELECT * FROM voto v INNER JOIN persona p ON v.idpersona=p.idpersona WHERE p.dni='$dni'";
		return ejecutarConsulta($sql);
	}

	public function listarapertura()
	{
		$sql="SELECT * FROM apertura";
		return ejecutarConsulta($sql);
	}


	public function listarpersona($dni)
	{
		$sql="SELECT * FROM persona p WHERE p.dni='$dni' and p.condicion='1' ";
		return ejecutarConsulta($sql);
	}

	public function confirvoto($idagrupacion,$idpersona,$fecha_actual,$hora)
	{
		$sql="INSERT INTO voto(idagrupacion,idpersona,fecha,hora,condicion) VALUES ('$idagrupacion','$idpersona','$fecha_actual','$hora','1')";
		return ejecutarConsulta($sql);
	}
}


?>