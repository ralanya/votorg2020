

<?php
require "../config/Conexion.php";
Class Actaelectoral {
 
	public function __construct()

	{ 
	}

	public function listar()
	{
		$sql="SELECT *,a.mesa as mesa,p.nombre as nombrep,p.apellidos as apellidosp,p1.nombre as nombres,p1.apellidos as apellidoss,p2.nombre as nombrev,p2.apellidos as apellidosv FROM actaelectoral a 
		inner join persona p on a.idpersonaP=p.idpersona 
		inner join persona p1 on a.idpersonaS=p1.idpersona 
		inner join persona p2 on a.idpersonaV=p2.idpersona  order by idactaelectoral desc";
		return ejecutarConsulta($sql);
	}



	public function insertar($mesa,$fecha,$horainicio,$horafin,$idpersonap,$idpersonas,$idpersonav,$personeros)
	{
		$sql="INSERT INTO actaelectoral (mesa,fecha,horainicio,horafin,idpersonaP,idpersonaS,idpersonaV,personeros) VALUES ('$mesa','$fecha','$horainicio','$horafin','$idpersonap','$idpersonas','$idpersonav','$personeros')";
		return ejecutarConsulta($sql);
	}

	public function editar($idactaelectoral,$mesa,$fecha,$horainicio,$horafin,$idpersonap,$idpersonas,$idpersonav,$personeros)
	{
		$sql="UPDATE actaelectoral SET mesa='$mesa',fecha='$fecha',horainicio='$horainicio',horafin='$horafin',idpersonaP='$idpersonap',idpersonaS='$idpersonas',idpersonaV='$idpersonav',personeros='$personeros'  WHERE idactaelectoral='$idactaelectoral'";
		return ejecutarConsulta($sql);
	}

	 public function mostrar($idactaelectoral)
	 {
	 	$sql="SELECT *,a.mesa as mesa,p.nombre as nombrep,p.apellidos as apellidosp,p.grado,p.seccion,p1.nombre as nombres,p1.apellidos as apellidoss,p1.grado as sgrado,p1.seccion as sseccion,p2.nombre as nombrev,p2.apellidos as apellidosv ,p2.grado as vgrado,p2.seccion as vseccion FROM actaelectoral a 
		inner join persona p on a.idpersonaP=p.idpersona 
		inner join persona p1 on a.idpersonaS=p1.idpersona 
		inner join persona p2 on a.idpersonaV=p2.idpersona WHERE idactaelectoral='$idactaelectoral'";
	 	return ejecutarConsultaSimpleFila($sql);
	 }

	 public function eliminarsel($id)
	{
		$sql="DELETE FROM actaelectoral WHERE  idactaelectoral in($id)";
		return ejecutarConsulta($sql);
	}




}


?>