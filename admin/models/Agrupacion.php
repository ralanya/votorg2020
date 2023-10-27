

<?php
require "../config/Conexion.php";
Class Agrupacion {

	public function __construct()

	{ 
	}

	public function listar()
	{
		$sql="SELECT * FROM agrupacion order by idagrupacion desc";
		return ejecutarConsulta($sql);
	}

	public function insertar($lista,$logo,$alcalde,$foto,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti)
	{
		$sql="INSERT INTO agrupacion (lista,logo,alcalde,foto,teniente_alcalde,regidor_ecrd,regidor_sa,regidor_eap,regidor_dna,regidor_cti,condicion) VALUES ('$lista','$logo','$alcalde','$foto','$teniente_alcalde','$regidor_ecrd','$regidor_sa','$regidor_eap','$regidor_dna','$regidor_cti','1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idagrupacion,$lista,$logo,$alcalde,$foto,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti)
	{
		$sql="UPDATE agrupacion SET lista='$lista',logo='$logo',alcalde='$alcalde',foto='$foto',teniente_alcalde='$teniente_alcalde',regidor_ecrd='$regidor_ecrd',regidor_sa='$regidor_sa',regidor_eap='$regidor_eap',regidor_dna='$regidor_dna',regidor_cti='$regidor_cti'  WHERE idagrupacion='$idagrupacion'";
		return ejecutarConsulta($sql);
	}

	public function update($idagrupacion,$lista,$logoac,$alcalde,$fotoac,$teniente_alcalde,$regidor_ecrd,$regidor_sa,$regidor_eap,$regidor_dna,$regidor_cti)
	{
		$sql="UPDATE agrupacion SET lista='$lista',logo='$logoac',alcalde='$alcalde',foto='$fotoac',teniente_alcalde='$teniente_alcalde',regidor_ecrd='$regidor_ecrd',regidor_sa='$regidor_sa',regidor_eap='$regidor_eap',regidor_dna='$regidor_dna',regidor_cti='$regidor_cti'  WHERE idagrupacion='$idagrupacion'";
		return ejecutarConsulta($sql);
	}

		public function desactivar($idagrupacion)
	{
		$sql="UPDATE agrupacion SET condicion='0' WHERE idagrupacion='$idagrupacion'";
		return ejecutarConsulta($sql);
	}


	public function activar($idagrupacion)
	{
		$sql="UPDATE agrupacion SET condicion='1' WHERE idagrupacion='$idagrupacion'";
		return ejecutarConsulta($sql);
	}


	public function eliminar($idagrupacion)
	{
		$sql="DELETE FROM agrupacion WHERE idagrupacion = '$idagrupacion'";
		return ejecutarConsulta($sql);
	}

	 public function mostrar($idagrupacion)
	 {
	 	$sql="SELECT * FROM agrupacion WHERE idagrupacion='$idagrupacion'";
	 	return ejecutarConsultaSimpleFila($sql);
	 }




}


?>