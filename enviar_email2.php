<?php
	require_once('cnx.php');
	require_once('funciones.php');
	$mail_usuario = $_POST['email'];
	$query = "SELECT pass FROM usuarios WHERE email = '$mail_usuario'";
	$rs = mysql_($query);
	$pass = mysql_fetch_assoc($rs);
?>
<?php 
$to  = $mail_usuario;
$asunto = "Pass";
/* message */
$message = "Tu contrase&ntilde;a es: ".$pass['pass']."<br>";
/////
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: YoSe+QueVos\r\n";

$mail_enviado = @mail($to, $asunto, $message, $headers);
////

if($mail_enviado){
	header( 'Location: recuperarpass.php?enviado=OK' );
}else{
	header( 'Location: recuperarpass.php?enviado=error' );	
};
?>