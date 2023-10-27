

<?php
require "../config/Conexion.php";
Class Count_voto 
{

	public function __construct()
	{ 
	}


	public function listar_voto()
	{
		$sql="SELECT count(idvoto) as idvoto FROM voto";
		return ejecutarConsulta($sql);
	}

	public function listar_agrupacion()
	{
		$sql="SELECT * FROM agrupacion where condicion='1' order by idagrupacion desc";
		return ejecutarConsulta($sql);
	}


	public function listar_persona()
	{
		$sql="SELECT count(idpersona) as idpersona FROM persona where condicion='1'";
		return ejecutarConsulta($sql);
	}


	public function voto_lista()
	{
		$sql="SELECT a.idagrupacion as idlistaragrupacion, a.lista,a.alcalde,a.logo, (count(v.idagrupacion))as total_voto_agrupacion FROM voto v inner join agrupacion a ON a.idagrupacion=v.idagrupacion group by v.idagrupacion";
		return ejecutarConsulta($sql);
	}



	public function listar_ie()
	{
		$sql="SELECT * FROM ie";
		return ejecutarConsulta($sql);
	}

	public function listar_mesas()
	{
		$sql="SELECT count(*) as total_mesa  FROM (SELECT  p.mesa FROM persona p  group by p.mesa) as total";
		return ejecutarConsulta($sql);
	}







}


?>