

<?php
require "../config/Conexion.php";
Class Usuario {

	public function __construct()
	{ 
	}

	public function listar()
	{
		$sql="SELECT * FROM usuario order by idusuario desc";
		return ejecutarConsulta($sql);
	}

	public function insertar($nombre,$apellidos,$login,$clave)
	{
		$sql="INSERT INTO usuario (nombre,apellidos,login,clave,condicion) VALUES ('$nombre','$apellidos','$login','$clave','1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idusuario,$nombre,$apellidos,$login,$clave)
	{
		$sql="UPDATE usuario SET nombre='$nombre',apellidos='$apellidos',login='$login',clave='$clave' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

		public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}


	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}


	public function eliminar($idusuario)
	{
		$sql="DELETE FROM usuario WHERE idusuario = '$idusuario'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function verificar($logina,$clavea)
    {
    	$sql="SELECT idusuario,nombre,apellidos,login,clave,condicion FROM usuario WHERE login='$logina' AND clave='$clavea' AND condicion='1' "; 
    	return ejecutarConsulta($sql);  
    }


}


?>