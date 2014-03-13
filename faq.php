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
		<?php include('inc/banda.php'); ?>
    </div>
    <div id="centro">
        <section id="faq">
        	<div style="font-size:16px;padding-bottom:20px;font-weight:bold;">FAQs</div>
            <p><b>¿Cómo registrarse?</b><br/>
            Ingresá en <a href="registrar.php">registro</a> y completá tus datos.</p><br/>
            <p><b>¿Qué pasa si pongo un DNI falso?</b><br/>
            En caso que el Juego entregue premios a los ganadores, no vas a poder cobrarlos ni tendrás derecho a reclamo alguno.</p><br/>
            <p><b>Perdí mi contraseña ¿Cómo la recupero?</b><br/>
            Completa tu email <a href="recuperarpass.php">acá</a> y te la enviamos a tu correo electrónico.</p><br/>
            <p><b>¿Cómo contesto preguntas?</b><br/>
            Entra en la sección <a href="preguntas.php">preguntas</a> y vas a poder ver las preguntas actuales que aun no respondiste.</p><br/>
            <p><b>¿Cómo cambio una respuesta?</b><br/>
            Una vez enviada la respuesta, no podrá ser modificada.</p><br/>
            <p><b>¿Puedo sugerir preguntas?</b><br/>
            Si, por favor hacerlo, completa el siguiente <a href="preguntas.php">formulario</a>.</p><br/>
            <p><b>¿Cómo recibo mi premio?</b><br/>
            Yosemasquevos te lo enviará por correo o algún otro medio.</p><br/>
            <p><b>¿Qué pasa si el premio no está disponible en el lugar donde vivo?</b><br/>
            Yosemasquevos no se hace responsable de la disponibilidad de los premios en toda la República Argentina.</p><br/>
            <p><b>¿Qué es un Torneo?</b><br/>
            Es el mismo juego de Yosemasquevos, pero en lugar de competir contra todos los participantes, solamente lo haces contra tus amigos.<br/>
            El administrador (creador) del torneo no puede enviar invitaciones. Para jugar en un Torneo, hay que buscarlo por nombre y solicitar permiso.<br/>
            El administrador podrá aceptar (o no) a los usuarios que quieran participar en su torneo.<br/>
            Todos los usuarios pueden crear Torneos.<br/>
            No hay límite de cantidad de Torneos creados por usuario.</p><br/>
        </section>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
</div>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript">
</script>
</body>
</html>