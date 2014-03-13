<?php
	require_once('cnx.php');
	require_once('funciones.php');
	require_once('seguridad.php');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yo s&eacute; m&aacute;s que vos</title>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="css/estilos.css" />
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<div id="contenido">
	<header id="header">
    	<?php include('inc/header.php'); ?>
    </header>
    <div id="banda">
		<div id="titulo_banda">Recuperar Contrase&ntilde;a</div>
        <div style="position:absolute;top:7px;right:30px;"><a href="index.php"><img src="img/home.png" /></a></div>
    </div>
    <div id="centro">
        <section id="recuperar_pass">
        <div id="titulo">Enviaremos tu contrase&ntilde;a a la cuenta de e-mail con la que te registraste.</div>
        <form id="form_recuperar_pass" name="form_recuperar_pass" action="enviar_email2.php" method="post" onsubmit="return validar_recuperar_pass()">
        	<label for="email">E-mail </label><input id="email" name="email" type="text" /><span class="error" id="error_email"></span>
            <div id="enviar_box"><input class="btn_form" type="submit" id="enviar" name="enviar" value="Enviar" /></div>
        </form>
        </section>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
</div>
<script type="text/javascript" src="js/code.js"></script>
<?php 
if(isset($_GET['enviado']) && $_GET['enviado'] == 'OK'){
	echo '<script type="text/javascript">alert("La contrase\u00F1a ha sido enviada a tu e-mail.");</script>';
}
?>
</body>
</html>