<?php
require_once("class.conexion.php");

Class Cliente
{
	public function __construct()
	{
		
	}
		
	public function getClientes()
	{
		global $mysqli;
		$list = array();
		$query = "SELECT * FROM empresa WHERE EMPRESA_FLAG = 1 ORDER BY RAND() LIMIT 50";
		$result = $mysqli->query($query) or die ("ERROR DE CONEXIÓN");
		while( $row = mysqli_fetch_assoc($result) ){
			$list[] = $row;
		}
		return $result;		
	}
}


?>