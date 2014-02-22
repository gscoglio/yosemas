<?php
	require_once('cnx.php');
	require_once('funciones.php');
	require_once('seguridad.php');
	if($user_id == 0){
		header('location:index.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yo s&eacute; m&aacute;s que vos</title>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery.forms.js"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="css/estilos.css" />
</head>
<body>
<div id="contenido">
	<header id="header">
    	<?php include('inc/header.php'); ?>
    </header>
    <div id="banda">
        <a href="perfil.php" id="perfil_editar">Ver Perfil</a>
        <div id="titulo_banda">Editar Perfil</div>
        <a href="logout.php" id="salir">Salir</a>
    </div>
    <div id="centro">
    	<?php 
		$usuario_datos = usuario_datos($user_id); 
		$nacimiento = explode('-', $usuario_datos['nacimiento']);
		$nacimiento = $nacimiento[2].'/'.$nacimiento[1].'/'.$nacimiento[0];
		?>
        
    	<form id="form_foto" enctype="multipart/form-data" action="operaciones.php" method="post">
        	<div id="marco_foto"><?php echo '<img src="fotos/'.$usuario_datos['foto'].'" />'; ?></div>
            <input type="button" name="cambiar_foto" class="btn_form" id="cambiar_foto" value="Cambiar Foto" />
        	<input type="file" name="foto" id="foto" style="visibility:hidden;" accept="image/jpg, image/jpeg"/>
            <input type="hidden" name="operacion" value="2" />
        </form>
        <form id="form_perfil" action="operaciones.php" method="post">
        	<label for="nick">
            	Nick: <span><?php echo $usuario_datos['usuario']; ?></span>
            </label>
            <div id="bloque_pass">
                <span id="cambiar_pass" onclick="$('.cambiar_pass').css('display','list-item');$('#centro #form_perfil #bloque_pass').css('height','90px');">Cambiar Contrase&ntilde;a</span>
                <div class="bloque_input">
                    <label class="cambiar_pass" for="pass">
                        <div class="ajuste"><span class="leyenda">Nueva Contrase&ntilde;a: &nbsp;</span><input type="password" name="pass" id="pass"  value="<?php echo $usuario_datos['pass']; ?>"/></div>
                    </label>
                    <span class="error" id="error_pass"></span><br />
                </div>
                <div class="bloque_input">
                    <label class="cambiar_pass" for="pass2">
                        <div class="ajuste"><span class="leyenda">Repetir Contrase&ntilde;a: </span><input type="password" name="pass2" id="pass2" value="<?php echo $usuario_datos['pass']; ?>" /></div>
                    </label>
                    <span class="error" id="error_pass2"></span><br />
                </div>
            </div>
            <div class="bloque_input">
            <label class="bloque_datos" for="nombre">
            	<div class="ajuste"><span class="leyenda">Nombre: </span><input type="text" name="nombre" id="nombre" value="<?php echo ucwords(strtolower($usuario_datos['nombre'])); ?>" /></div>
            </label>
            <span class="error" id="error_nombre"></span><br />
            </div>
            <div class="bloque_input">
            <label class="bloque_datos" for="apellido">
            	<div class="ajuste"><span class="leyenda">Apellido: </span><input type="text" name="apellido" id="apellido" value="<?php echo ucwords(strtolower($usuario_datos['apellido'])); ?>" /></div>
            </label>
            <span class="error" id="error_apellido"></span><br />
            </div>
            <div class="bloque_input" id="bloque_mail">
                <label for="email" id="email_label">
                    <div class="ajuste"><span class="leyenda" style="margin-right:10px;">E-mail: </span><input type="text" name="email" id="email" value="<?php echo $usuario_datos['email']; ?>" /></div>
                </label>
                <span class="error" id="error_email"></span><br />
            </div>
            <label>
            	Fecha de nacimiento: <span><?php echo $nacimiento; ?></span>
            </label>
            <label>
            	Sexo: <span><?php echo ucwords($usuario_datos['sexo']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                DNI: <span><?php echo $usuario_datos['dni']; ?></span>
            </label>
            <label>
            	Provincia: <span><?php echo utf8_decode($usuario_datos['provincia']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                Localidad: <span><?php echo ucwords(strtolower($usuario_datos['localidad'])); ?></span>
            </label>
            <div class="bloque_input">
            <label class="bloque_datos" for="twitter">
            	<div class="ajuste"><span class="leyenda">Twitter: </span>
                <?php echo '<input type="text" name="twitter" id="twitter" value="'; 
				if($usuario_datos['twitter']){
					echo $usuario_datos['twitter']; 
				}
				else{
					echo '';	
				}
                echo '" />';
                ?>
            </div>
            </label>
            <span class="error" id="error_twitter"></span><br />
            </div>
            <div class="bloque_input">
            <label class="bloque_datos" for="telefono">
            	<div class="ajuste"><span class="leyenda">Tel&eacute;fono: </span>
                <?php echo '<input type="text" name="telefono" id="telefono" value="'; 
				if($usuario_datos['telefono']){
					echo $usuario_datos['telefono']; 
				}
				else{
					echo '';	
				}
                echo '" />';
                ?>
            </div>
            </label>
            <span class="error" id="error_telefono"></span><br />
            </div>
            <div class="bloque_input">
            <label class="bloque_datos" for="celular">
            	<div class="ajuste"><span class="leyenda">Celular: </span>
                <?php echo '<input type="text" name="celular" id="celular" value="'; 
				if($usuario_datos['celular']){
					echo $usuario_datos['celular']; 
				}
				else{
					echo '';	
				}
                echo '" />';
                ?>
            </div>
            </label>
            <span class="error" id="error_celular"></span><br />
            </div><br />
            <input type="button" name="enviar" id="enviar" class="btn_form" value="Guardar Cambios" onclick="validar_perfil()" />
            <input type="hidden" name="foto_usuario" id="foto_usuario" value="<?php echo $usuario_datos['foto']; ?>" />
            <input type="hidden" name="operacion" value="17" />
        </form>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
</div>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript">
$('#botonera_ppal a').hover(function(){
	$(this).css({
		'color': btn_over
	});
},
function(){
	$(this).css({
		'color': btn_color
	});
});
</script>
</body>
</html>