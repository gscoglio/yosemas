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
    	<section id="datos_usuario"><?php include('inc/perfil.php'); ?></section>
        <section id="contacto">
        <div id="titulo">Contacto</div>
        <?php
            if($user_id == 0){
        		echo '<form id="form_contacto" name="form_contacto" action="enviar_email.php" method="post" onsubmit="return validar_contacto()">';
                echo '<label for="nombre">Nombre</label><input id="nombre" name="nombre" type="text" /><span class="error" id="error_nombre"></span>';
                echo '<label for="email">E-mail </label><input id="email" name="email" type="text" /><span class="error" id="error_email"></span>';
            }
			else{
				$datos_usuario = usuario_datos($user_id);
				echo '<form id="form_contacto" name="form_contacto" action="enviar_email.php" method="post" onsubmit="return validar_contacto_logged()">';
				echo '<input id="nombre" name="nombre" type="hidden" value="'.$datos_usuario['nombre'].' '.$datos_usuario['apellido'].'" />';
                echo '<input id="email" name="email" type="hidden" value="'.$datos_usuario['email'].'" />';
			}
            ?>
            <label for="asunto">Asunto </label><input id="asunto" name="asunto" type="text" /><span class="error" id="error_asunto"></span>
            <label for="mensaje">Mensaje</label><textarea id="mensaje" name="mensaje"></textarea><span class="error" id="error_mensaje"></span>
            <div id="enviar_box"><input class="btn_form" type="submit" id="enviar" name="enviar" value="Enviar" /></div>
        <?php echo'</form>'; ?>
        </section>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
</div>
<script type="text/javascript" src="js/code.js"></script>
<?php 
if(isset($_GET['enviado']) && $_GET['enviado'] == 'OK'){
	echo '<script type="text/javascript">alert("El mensaje ha sido enviado con \u00e9xito");</script>';
}
?>
</body>
</html>