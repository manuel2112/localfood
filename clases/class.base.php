<?php
require_once("class.conexion.php");

Class Base
{
	public function __construct()
	{
		
	}
		
	public function getBase()
	{
		global $mysqli;
		$list = array();
		$query = "SELECT * FROM base WHERE BASE_ID = 1 ";
		$result = $mysqli->query($query) or die ("ERROR DE CONEXIÓN");
		$row = mysqli_fetch_assoc($result);
		return $row;		
	}
}


?>