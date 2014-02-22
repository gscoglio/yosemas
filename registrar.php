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
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="js/jquery.forms.js"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="css/estilos.css" />
<link type="text/css" rel="stylesheet" href="css/datepicker.css" />
</head>
<body>
<div id="contenido">
	<header id="header">
    	<?php include('inc/header.php'); ?>
    </header>
    <div id="banda">
        <div id="titulo_banda">Registrate</div>
        <div style="position:absolute;top:7px;right:30px;"><a href="index.php"><img src="img/home.png" /></a></div>
    </div>
    <div id="centro">
        <form id="form_foto" enctype="multipart/form-data" action="operaciones.php" method="post">
        	<div id="marco_foto"><img src="fotos/default_avatar.jpg" /></div>
            <input type="button" name="cambiar_foto" class="btn_form" id="cambiar_foto" value="Cambiar Foto" />
        	<input type="file" name="foto" id="foto" style="visibility:hidden;" />
            <input type="hidden" name="operacion" value="2" />
        </form>
        <form id="form_registro" action="operaciones.php" method="post" onSubmit="return validar_registrar()">
        	<label for="nick">Nick: </label><input type="text" name="nick" id="nick" />
            <span class="error" id="error_nick"></span>
            <label for="pass">Contrase&ntilde;a: </label><input type="password" name="pass" id="pass" />
            <span class="error" id="error_pass"></span>
            <label for="pass2">Repetir Contrase&ntilde;a: </label><input type="password" name="pass2" id="pass2" />
            <span class="error" id="error_pass2"></span>
            <label for="email">E-mail: </label><input type="text" name="email" id="email" />
            <span class="error" id="error_email"></span>
        	<label for="nombre">Nombre: </label><input type="text" name="nombre" id="nombre" />
            <span class="error" id="error_nombre"></span>
            <label for="apellido">Apellido: </label><input type="text" name="apellido" id="apellido" />
            <span class="error" id="error_apellido"></span>
            <label for="pick_date">Fecha de nacimiento: </label>
            <input type="text" name="nacimiento" style="color:#fff;" id="nacimiento" value="<?php echo date('d/m/Y'); ?>" />
            <span class="error" id="error_nacimiento"></span>
            <label for="sexo">Sexo: </label>
            <select name="sexo" id="sexo" size="1">
                <option value="F">Femenino</option>
                <option value="M">Masculino</option>
            </select>
            <span class="error" id="error_sexo"></span>
            <label for="dni">DNI: </label><input type="text" name="dni" id="dni" />
            <span class="error" id="error_dni"></span>
            <label for="provincia">Provincia: </label>
            <select id="provincia" name="provincia" size="1" onchange="set_localidades()">
                <?php
                $provincias = get_provincias();
                $tot_provincias = sizeof($provincias);
				if(isset($provincias)){
					foreach($provincias as $key){
						echo '<option value="'.$key['id'].'">'.utf8_decode($key['provincia']).'</option>';
					}
				};
                ?>
            </select>
            <span class="error" id="error_provincia"></span>
            <label for="localidad">Localidad: </label><select id="localidad" name="localidad" size="1"></select>
            <label for="twitter">Twitter <span class="opcional">(opcional)</span>: </label><input type="text" name="twitter" id="twitter" />
            <span class="error" id="error_twitter"></span>
            <label for="telefono">Tel&eacute;fono <span class="opcional">(opcional)</span>: </label><input type="text" name="telefono" id="telefono"/>
            <span class="error" id="error_telefono"></span>
            <label for="celular">Celular <span class="opcional">(opcional)</span>: </label><input type="text" name="celular" id="celular"/>
            <span class="error" id="error_celular"></span>
            <label for="terminos"><input type="checkbox" name="terminos" id="terminos" /> Acepto los <a href="reglamento.php">t&eacute;rminos y condiciones.</a><span class="error" id="error_terminos"></span></label>
            <input type="submit" name="enviar" id="enviar" class="btn_form" value="Enviar" />
            <input type="hidden" id="hoy" name="hoy" value="<?php echo date('d/m/Y'); ?>" />
            <input type="hidden" name="foto_usuario" id="foto_usuario" value="default_avatar.jpg" />
            <input type="hidden" name="operacion" value="7" />
        </form>
        <div id="nota_registro">
        	<img src="img/importante_register.png" />
        </div>
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