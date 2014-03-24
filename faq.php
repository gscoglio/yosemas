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
            <h1>Preguntas Frecuentes</h1><br/><br/>
            <h3>REGISTRO</h3><br/>
            <h4>¿Cómo registrarse?</h4><br/>
            <p>Ingresá en <a href="registrar.php">registro</a> y completá tus datos.</p><br/>
            <h4>Perdí mi contraseña ¿Cómo la recupero?</h4><br/>
            <p>Completa tu email <a href="recuperarpass.php">acá</a> y te la enviamos a tu correo electrónico.</p><br/><br/>
            <h3>PREGUNTAS</h3><br/>
            <h4>¿Cómo contesto preguntas?</h4><br/>
            <p>Entra en la sección <a href="preguntas.php">preguntas</a> y vas a poder ver las preguntas actuales que aún no respondiste.</p><br/>
            <h4>¿Cuándo hay preguntas nuevas?</h4><br/>
            <p>Todos los días hay preguntas nuevas.</p><br/>
            <h4>¿Cuántas preguntas hay?</h4><br/>
            <p>Hay entre 15 y 30 preguntas por categoría por mes. En total, entre 60 y 120 preguntas al mes.</p><br/>
            <h4>¿Cómo cambio una respuesta?</h4><br/>
            <p>Una vez enviada la respuesta, no podrá ser modificada.</p><br/>
            <h4>¿Hasta cuándo tengo tiempo de responder una pregunta?</h4><br/>
            <p>A la derecha de la pregunta podes ver la fecha y hora de vencimiento.</p><br/>
            <h4>¿Qué pasa si no respondo una pregunta?</h4><br/>
            <p>Nada. Aunque no tenes la posibilidad de sumar puntos por esa pregunta.</p><br/>
            <h4>¿Puedo sugerir preguntas?</h4><br/>
            <p>Si, por favor hacerlo, haciendo click <a href="preguntas.php">acá</a>.</p><br/><br/>
            <h3>PUNTOS</h3><br/>
            <h4>¿Cuántos puntos hay disponibles?</h4><br/>
            <p>Hay 500 puntos por categoría por mes. En caso de acertar todas las preguntas, podes sumar como máximo 2000 puntos en el mes.</p><br/>
            <h4>¿Cómo calculan los puntos que vale cada pregunta?</h4><br/>
            <p>Debido a su nivel de dificultad.</p><br/><br/>
            <h3>POSICIONES</h3><br/>
            <h4>¿Cuándo se actualizan las posiciones?</h4><br/>
            <p>Entre 24 y 48 horas luego de sucedido el evento, vas a poder ver tus puntos en las posiciones.</p><br/>
            <h4>¿Puedo ver las posiciones de mi ciudad?</h4><br/>
            <p>Sí, utilizando los filtros que aparecen en la página.</p><br/><br/>
            <h3>TORNEOS</h3><br/>
            <h4>¿Qué es un Torneo?</h4><br/>
            <p>Es el mismo juego de Yosemasquevos, pero en lugar de competir contra todos los participantes, solamente lo haces contra tus amigos.</p><br/>
            <h4>¿Cómo se crea un torneo?</h4><br/>
            <p>Haces click en Torneos, luego en Crear, pones el nombre y listo.</p><br/>
            <h4>¿Cómo se invita gente a que juegue el torneo?</h4><br/>
            <p>El administrador (creador) del torneo no puede enviar invitaciones. Para jugar en un Torneo, hay que buscarlo por nombre y solicitar permiso.</p>
            <p>El administrador podrá aceptar (o no) a los usuarios que quieran participar en su torneo.</p><br/>
            <h4>¿Quién puede crear un torneo?</h4><br/>
            <p>Todos los usuarios pueden crear Torneos.</p><br/>
            <h4>¿En cuántos torneos puedo crear/participar?</h4><br/>
            <p>No hay límite de cantidad de Torneos que cada usuario puede crear o participar.</p>
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