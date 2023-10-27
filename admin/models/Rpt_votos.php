

<?php
require "../config/Conexion.php";
Class Rpt_votos {

	public function __construct()

	{ 
	}



	public function listar()
	{
		$sql="SELECT *,v.condicion as condicion_voto FROM voto v inner join persona p on v.idpersona=p.idpersona where v.idpersona=p.idpersona order by v.idvoto asc ";
		return ejecutarConsulta($sql);
	}

		public function listar_count_total()
	{
		$sql="SELECT count(idvoto) as total FROM voto ";
		return ejecutarConsulta($sql);
	}


		public function listar_num_mesa()
	{
		$sql="SELECT p.idpersona, p.mesa FROM  persona p  group by p.mesa order by p.mesa ";
		return ejecutarConsulta($sql);
	}

	public function listar_num_mesa_acta()
	{
		$sql="SELECT *FROM  actaelectoral ";
		return ejecutarConsulta($sql);
	}


		public function listar_persona($mesa_num)
	{
		$sql="SELECT * FROM persona p where p.mesa='$mesa_num' ";
		return ejecutarConsulta($sql);
	}



	public function listar_mesa($mesa_num)
	{
		$sql="SELECT *,v.condicion as condicion_voto FROM voto v inner join persona p on v.idpersona=p.idpersona where p.mesa='$mesa_num' order by v.idvoto asc ";
		return ejecutarConsulta($sql);
	}

			public function listar_count_total_mesa($mesa_num)
	{
		$sql="SELECT count(v.idvoto) as total FROM voto v inner join persona p on v.idpersona=p.idpersona where p.mesa='$mesa_num' order by v.idvoto asc ";
		return ejecutarConsulta($sql);
	}

		public function listar_count_valido_mesa($mesa_num)
	{
		$sql="SELECT count(v.idvoto) as valido FROM voto v inner join persona p on v.idpersona=p.idpersona where v.condicion='1' and v.idagrupacion<>'1' and p.mesa='$mesa_num' ";
		return ejecutarConsulta($sql);
	}




		public function listar_count_blanco_mesa($mesa_num)
	{
		$sql="SELECT count(v.idagrupacion) as blanco FROM voto v inner join persona p on v.idpersona=p.idpersona where v.idagrupacion='1' and v.condicion<>'0'and p.mesa='$mesa_num'";
		return ejecutarConsulta($sql);
	}

	public function listar_agrupacion_voto()
	{
		$sql="SELECT a.idagrupacion,a.lista,a.logo,count(v.idagrupacion)as votos 
		FROM agrupacion a 
		left join voto v on a.idagrupacion=v.idagrupacion 
			where a.condicion=1 
			group by a.idagrupacion order By a.idagrupacion desc";
		return ejecutarConsulta($sql);
	}


		public function listar_contador($mesa)
	{
		$sql="SELECT v.idagrupacion as item, a.lista as lista_a,a.logo , p.apellidos,p.nombre,p.mesa,count(v.idagrupacion)as votosa FROM voto v inner join persona p on v.idpersona=p.idpersona inner join agrupacion a on v.idagrupacion=a.idagrupacion where v.idpersona=p.idpersona and p.mesa='$mesa' GROUP BY v.idagrupacion order by v.idvoto asc";
		return ejecutarConsulta($sql);
	}



	public function count()
	{
		$sql="SELECT count(v.idvoto)as total FROM voto v ";
		return ejecutarConsulta($sql);
	}

		public function listar_acta($mesa)
	{
		$sql="SELECT *,a.mesa as mesa_ac,p.nombre as nombrep,p.apellidos as apellidosp,p.grado as gradop,p.seccion as seccionp,p1.nombre as nombres,p1.apellidos as apellidoss,p1.grado as grados,p1.seccion as seccions,p2.nombre as nombrev,p2.apellidos as apellidosv,p2.grado as gradov,p2.seccion as seccionv FROM actaelectoral a 
		inner join persona p on a.idpersonaP=p.idpersona 
		inner join persona p1 on a.idpersonaS=p1.idpersona 
		inner join persona p2 on a.idpersonaV=p2.idpersona  where  a.mesa='$mesa' ";
		return ejecutarConsulta($sql);
	}

		public function total_votos_mesa($mesa)
	{
		$sql="SELECT count(v.idagrupacion)as votos_mesa FROM voto v inner join persona p on v.idpersona=p.idpersona inner join agrupacion a on v.idagrupacion=a.idagrupacion where v.idpersona=p.idpersona and p.mesa='$mesa' GROUP BY p.mesa";
		return ejecutarConsulta($sql);
	}

		public function listar_ie()
	{
		$sql="SELECT *from ie";
		return ejecutarConsulta($sql);
	}



// SELECT a.lista as lista_a,a.logo , p.apellidos,p.nombre,p.mesa,count(v.idagrupacion)as votos FROM voto v inner join persona p on v.idpersona=p.idpersona inner join agrupacion a on v.idagrupacion=a.idagrupacion where v.idpersona=p.idpersona and p.mesa='2' GROUP BY v.idagrupacion order by v.idvoto asc







}


?>
