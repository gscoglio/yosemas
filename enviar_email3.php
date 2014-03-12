<?php 
$to  = "consultas@yosemasquevos.com";
$pregunta = nl2br($_POST['texto']);
$message .= $pregunta."<br>";
$asunto = "Alguien sugiere una pregunta en " . $_POST['categoria'];
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: sugerencias@yosemasquevos.com\r\n";

try {
    mail($to, $asunto, $message, $headers);
} catch (Exception $exc) {
    return false;
}

return true;