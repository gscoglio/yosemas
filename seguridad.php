<?php
if (isset($_POST['usuario'])) {
	$usuario=$_POST['usuario'];
	$pass=$_POST['pass'];
}
elseif (isset($_GET['usuario'])) {
	$usuario=$_GET['usuario'];
	$pass=$_GET['pass'];
}

if(isset($usuario))
{
	$query=sprintf("SELECT usuario, pass, id, email FROM usuarios WHERE (usuario=%s AND pass=%s) OR (email=%s AND pass=%s)",
	GetSQLValueString($usuario, "text"), GetSQLValueString($pass, "text"), GetSQLValueString($usuario, "text"), GetSQLValueString($pass, "text")); 
	
	$login = mysql_($query);
	$existe_usuario = mysql_num_rows($login);
	if ($existe_usuario) {
		//Variables de sesión.
		$usuarios = mysql_fetch_assoc($login);
		$_SESSION['id'] = $usuarios['id'];
		$user_id = $_SESSION['id'];
		$_SESSION['email'] = $usuarios['email'];
		$user_email = $_SESSION['email'];
		$_SESSION['usuario'] = $usuarios['usuario'];
		$nick = $_SESSION['usuario'];
		header('location:preguntas.php');
	}
}
if( isset($_SESSION['usuario'])){
	$user_id = $_SESSION['id'];
	$user_email = $_SESSION['email'];
	$nick = $_SESSION['usuario'];
}
else{
	$user_id = 0;
	$user_email = '';
	$nick = '';
}
?>