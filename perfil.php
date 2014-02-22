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
    	<a href="perfil_editar.php" id="perfil_editar">Editar Perfil</a>
        <div id="titulo_banda">Perfil de <?php echo ucwords(strtolower($nick)); ?></div>
        <a href="logout.php" id="salir">Salir</a>
    </div>
    <div id="centro">
    	<?php 
		$usuario_datos = usuario_datos($user_id); 
		$nacimiento = explode('-', $usuario_datos['nacimiento']);
		$nacimiento = $nacimiento[2].'/'.$nacimiento[1].'/'.$nacimiento[0];
		?>
        
    	<form id="form_foto">
        	<div id="marco_foto"><?php echo '<img src="fotos/'.$usuario_datos['foto'].'" />'; ?></div>
        </form>
        <form id="form_perfil">
        	<label>
            	Nick: <span><?php echo $usuario_datos['usuario']; ?></span>
            </label>
        	<label>
            	Nombre: <span><?php echo ucwords(strtolower($usuario_datos['nombre'])); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                Apellido: <span><?php echo ucwords(strtolower($usuario_datos['apellido'])); ?></span>
            </label>
            <label for="pick_date">
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
            <label>
                E-mail: <span><?php echo $usuario_datos['email']; ?></span>
            </label>
            <label>
            	Twitter: <span>
				<?php 
				if($usuario_datos['twitter']){
					echo $usuario_datos['twitter']; 
				}
				else{
					echo '--';	
				}
				?></span>
            </label>
            <label>
            	Tel&eacute;fono: <span>
				<?php 
				if($usuario_datos['telefono']){
					echo $usuario_datos['telefono']; 
				}
				else{
					echo '--';	
				}
				?></span>
            </label>
            <label>
            	Celular: <span>
				<?php 
				if($usuario_datos['celular']){
					echo $usuario_datos['celular']; 
				}
				else{
					echo '--';	
				}
				?></span>
            </label>
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