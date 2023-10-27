

<?php
require "admin/config/Conexion.php";
Class Agrupacion {

	public function __construct()

	{ 
	}

	public function listar()
	{
		$sql="SELECT * FROM agrupacion where condicion='1' order by idagrupacion desc";
		return ejecutarConsulta($sql);
	}

	public function listarie()
	{
		$sql="SELECT * FROM ie ";
		return ejecutarConsulta($sql);
	}

}


?>