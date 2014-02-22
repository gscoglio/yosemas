<?php
include 'constantes.php';

$cnx = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($db, $cnx);
mysql_query("SET NAMES 'utf8'");
header('Content-Type: text/html; charset=UTF-8'); 

if (!isset($_SESSION)) {
	session_start();
}
?>