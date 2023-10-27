

<?php
require "../config/Conexion.php";
Class Ie
 {

	public function __construct()

	{ 
	}



	public function editar($idie,$nombre,$logo,$anio,$departamento,$provincia,$distrito)
	{
		$sql="UPDATE ie SET nombre='$nombre',logo='$logo',anio='$anio',departamento='$departamento',provincia='$provincia',distrito='$distrito' WHERE idie='$idie'";
		return ejecutarConsulta($sql);
	}

	public function update($idie,$nombre,$logoac,$anio,$departamento,$provincia,$distrito)
	{
		$sql="UPDATE ie SET nombre='$nombre',logo='$logoac',anio='$anio',departamento='$departamento',provincia='$provincia',distrito='$distrito' WHERE idie='$idie'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($idie)
	{
		$sql="DELETE FROM ie WHERE idie = '$idie'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idie)
	{
		$sql="SELECT i.idie,i.nombre,i.logo,i.anio,i.departamento,i.provincia,i.distrito FROM ie i  WHERE i.idie='$idie'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql="SELECT * FROM ie ";
		return ejecutarConsulta($sql);
	}


}


?>