<?php
include('cnx.php');
if(isset($_GET['operacion'])){$operacion = $_GET['operacion'];}
if(isset($_GET['id'])){$id = $_GET['id'];}

switch($operacion){
	case 1:
		$query = "DELETE FROM novedades WHERE id = $id";
		$rs = mysql_query($query, $cnx);
		
		header('location: novedades.php');
	break;	
	case 2:
		$query = "DELETE FROM premios WHERE id = $id";
		$rs = mysql_query($query, $cnx);
		
		header('location: premios.php');
	break;
}
?>