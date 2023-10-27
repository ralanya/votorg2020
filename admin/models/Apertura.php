<?php 

require "../config/Conexion.php";

Class Apertura
{

	public function __construct()
	{

	}


	public function editar($idapertura,$fecha_star,$fecha_end)
	{
		$sql="UPDATE apertura SET fecha_star='$fecha_star',fecha_end='$fecha_end' WHERE idapertura='$idapertura'";
		return ejecutarConsulta($sql);
	}


	public function mostrar($idapertura)
	{
		$sql="SELECT a.idapertura,a.fecha_star,a.fecha_end FROM apertura a  WHERE a.idapertura=idapertura";
		return ejecutarConsultaSimpleFila($sql);
	}


	public function listar()
	{
		$sql="SELECT * FROM apertura";
		return ejecutarConsulta($sql);		
	}


	public function desactivar($idapertura)
	{
		$sql="UPDATE apertura SET condicion='0' WHERE idapertura='$idapertura'";
		return ejecutarConsulta($sql);
	}


	public function activar($idapertura)
	{
		
		$sql="UPDATE apertura SET condicion='1' WHERE idapertura='$idapertura'";
		return ejecutarConsulta($sql);
	}

}

?>