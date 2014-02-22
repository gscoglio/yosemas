<?php 
$to  = "consultas@yosemasquevos.com";
$mail_usuario = $_POST['email'];
$consulta = nl2br($_POST['mensaje']);
$asunto = $_POST['asunto'];
/* message */
$message = "Nombre: ".$_POST['nombre']."<br>";
$message .= "E-mail: ".$mail_usuario."<br><br>";
$message .= $consulta."<br>";
/////
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: $mail_usuario\r\n";

$mail_enviado = @mail($to, $asunto, $message, $headers);
////

if($mail_enviado){
	header( 'Location: contacto.php?enviado=OK' );
}else{
	header( 'Location: contacto.php?enviado=error' );	
};
?>