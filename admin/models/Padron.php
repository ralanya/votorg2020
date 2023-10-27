

<?php
require "../config/Conexion.php";
Class Persona {

	public function __construct()

	{ 
	}

	public function listar()
	{
		$sql="SELECT * FROM persona order by idpersona desc";
		return ejecutarConsulta($sql);
	}



	public function insertar($nombre,$apellidos,$dni,$grado,$seccion,$mesa)
	{
		$sql="INSERT INTO persona (nombre,apellidos,dni,grado,seccion,mesa,condicion) VALUES ('$nombre','$apellidos','$dni','$grado','$seccion','$mesa','1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idpersona,$nombre,$apellidos,$dni,$grado,$seccion,$mesa)
	{
		$sql="UPDATE persona SET nombre='$nombre',apellidos='$apellidos',dni='$dni',grado='$grado',seccion='$seccion',mesa='$mesa'  WHERE idpersona='$idpersona'";
		return ejecutarConsulta($sql);
	}


		public function desactivar($idpersona)
	{
		$sql="UPDATE persona SET condicion='0' WHERE idpersona='$idpersona'";
		return ejecutarConsulta($sql);
	}


	public function activar($idpersona)
	{
		
		$sql="UPDATE persona SET condicion='1' WHERE idpersona='$idpersona'";
		return ejecutarConsulta($sql);
	}


	public function eliminarsel($id)
	{
		$sql="DELETE FROM persona WHERE  idpersona in($id)";
		return ejecutarConsulta($sql);
	}


	 public function mostrar($idpersona)
	 {
	 	$sql="SELECT * FROM persona WHERE idpersona='$idpersona'";
	 	return ejecutarConsultaSimpleFila($sql);
	 }




	 	public function listar_left()
	{
		$sql="SELECT p.idpersona,p.nombre,p.apellidos,p.dni,p.grado,p.seccion,p.condicion,p.mesa,v.idpersona idpersonanew FROM persona p where p.idpersona<>v.idpersona inner join voto v on p.idpersona=v.idpersona order by p.grado asc";
		return ejecutarConsulta($sql);
	}

	public function autocomplete($searchTerm)
	{
		$sql="SELECT * FROM persona WHERE nombre  LIKE  '%".$searchTerm."%' OR dni  LIKE '%".$searchTerm."%' OR apellidos  LIKE '%".$searchTerm."%' ";
		return ejecutarConsulta($sql);	
	}

}


?>