

<?php
require "../config/Conexion.php";
Class Resultados {

	public function __construct()

	{ 
	}


	public function activar($idvoto)
	{
		
		$sql="UPDATE voto SET condicion='1' WHERE idvoto='$idvoto'";
		return ejecutarConsulta($sql);
	}



	public function eliminarsel($id)
	{
		$sql="DELETE FROM voto WHERE idvoto in($id)";
		return ejecutarConsulta($sql);
	}




	public function listar_votosR()
	{
		$sql="SELECT *,v.condicion as condicion_voto FROM voto v inner join persona p on v.idpersona=p.idpersona where v.idpersona=p.idpersona order by v.idvoto asc ";
		return ejecutarConsulta($sql);
	}


	public function listar_votosF()
	{
		$sql="SELECT p.idpersona,p.nombre,p.apellidos,p.dni,p.grado,p.seccion,p.condicion,p.mesa,v.idpersona as newidpersona FROM persona p left join voto v on p.idpersona=v.idpersona where v.idpersona is null order by p.grado asc ";
		return ejecutarConsulta($sql);
	}




}


?>