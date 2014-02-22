<?php
include '../constantes.php';

$cnx = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($db, $cnx);
mysql_query("SET NAMES 'utf8'");

if (!isset($_SESSION)) {
	session_start();
}
if(!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
	  if(PHP_VERSION < 6){
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	  }
	
	  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
	  switch($theType){
		case "text":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;    
		case "long":
		case "int":
		  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
		  break;
		case "double":
		  $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
		  break;
		case "date":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;
		case "defined":
		  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
		  break;
	  }
	  return $theValue;
	}
}
if (isset($_SESSION['admin']) && $_SESSION['admin'] != "") {
	$usuario=$_SESSION['admin'];
	$pass=$_SESSION['pass_admin'];
	
	$query=sprintf("SELECT quien, sos FROM baby_admin WHERE quien=%s AND sos=%s",
	GetSQLValueString($usuario, "text"), GetSQLValueString($pass, "text")); 
	
	$rs = mysql_query($query, $cnx) or die(mysql_error());
	$usuarios = mysql_num_rows($rs);
	if (!($usuarios)) {
		//declaro las variables de sesión.
		$_SESSION['admin'] = "";
		$_SESSION['pass_admin'] = "";
		header('location:login.php');
	}
}
else
{
	$_SESSION['admin'] = "";
	$_SESSION['pass_admin'] = "";
	header('location:login.php');
}

function date_time($fecha){
	$fecha = explode(' ',$fecha);
	$fecha[0] = explode('-',$fecha[0]);
	$fecha[1] = explode(':',$fecha[1]);
	$fecha = $fecha[0][2].'/'.$fecha[0][1].'/'.$fecha[0][0].' '.$fecha[1][0].':'.$fecha[1][1];	
	return $fecha;
}
?>