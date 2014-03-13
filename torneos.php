<?php
	require_once('cnx.php');
	require_once('funciones.php');
	require_once('seguridad.php');
	require_once('estado_preguntas.php');
	
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
        <section id="torneos">
            <div id="contenido">
            </div>
            <?php if ($user_id != 0){  ?>
                <div id="torneos_usuario">
                    <div class="titulo">Jugando</div>
                    <?php 
                    $torneos_usuario = torneos_usuario($user_id, 1);
                    $i = 0;
                    foreach($torneos_usuario as $key){
                    $torneo_id = $key["id"];
                    echo '<div class="bloque_torneo"><div class="nombre">'.$key["nombre_torneo"];
					if($key["id_usuario"] == $user_id){
						echo ' <b>(A)</b>';
					}
					echo '</div>';
                    echo '<div class="ir" onclick="mostrar_torneos('.$torneo_id.','.$user_id.',2)"><img src="img/ir.png" alt="Eliminar" title="Ir a torneo" /></div>';
					if($key["id_usuario"] == $user_id){
                    	echo '<div class="abandonar" onclick="x=confirm(\'Est\u00e1s por eliminar el torneo '.$key["nombre_torneo"].'.\');if(x){abandonar_torneo('.$key["id"].','.$key["estado"].');};"><img src="img/eliminar.png" alt="Eliminar" title="Eliminar torneo" /></div>';
					}
					else{
                    	echo '<div class="abandonar" onclick="x=confirm(\'Est\u00e1s por abandonar el torneo '.$key["nombre_torneo"].'.\');if(x){abandonar_torneo('.$key["id"].','.$key["estado"].');};"><img src="img/eliminar.png" alt="Eliminar" title="Abandonar torneo" /></div>';
					}
					echo '</div>';
                    $i++; 
                	} ?>
                </div>
                <div id="torneos_pendiente">
                    <div class="titulo">Pendientes de confirmaci&oacute;n</div>
                    <?php 
                    $torneos_pendientes = torneos_usuario($user_id, 0);
                    $i = 0;
					if(isset($torneos_pendientes)){
						foreach($torneos_pendientes as $key){
							echo '<div class="bloque_torneo">';
							echo '<div class="nombre">'.$key["nombre_torneo"].'</div>';
							echo '<div class="abandonar" onclick="abandonar_torneo('.$key["id"].','.$key["estado"].')"><img src="img/eliminar.png" alt="Eliminar" title="Abandonar torneo" /></div>';
							echo '</div>';
							$i++;
						}
					}?>
                </div>
			<?php } ?>
        </section>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
    <input type="hidden" id="user_id" value="<?php echo $user_id; ?>" />
</div>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript">
	$('#botonera_ppal #torneos a').css({
			'color': btn_select
	});
	var user_id = $('#user_id').val();
	mostrar_torneos(0,10,1);
</script>
</body>
</html>