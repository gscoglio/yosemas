<?php
	require_once('cnx.php');
	require_once('funciones.php');
	require_once('seguridad.php');
	require_once('estado_preguntas.php');

	$resp = preguntas($user_id, 1);
	$preguntas = $resp[0];
	$respuestas = $resp[1];
	$premios = get_premios();
	$novedades = get_novedades();
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
<div id="contenido">
	<header id="header">
    	<?php include('inc/header.php'); ?>
    </header>
    <div id="banda">
		<?php include('inc/banda.php'); ?>
    </div>
    <div id="centro">
        <div id="subtitulo">&iquest;Sos el que m&aacute;s sabe de todo? &iexcl;Demostralo!</div>
        <div id="video_index">
        <img src="img/video.png" />
        </div>
        <div id="pregunta_index">
        	<div class="info_pregunta">
                <div class="titulo" style="border-bottom:2px solid <?php echo color($preguntas[0]['id_categoria']); ?>;">
                    &iquest;<?php echo $preguntas[0]['pregunta']; ?>?
                </div>
                <div class="respuestas">
                <?php for($j=0; $j < count($respuestas[0]); $j++){ ?>
                <div class="opcion">
                    <input type="radio" name="respuesta<?php echo $i; ?>" value="<?php echo $respuestas[0][$j]['id_respuesta']; ?>" />
                    <?php echo $respuestas[0][$j]['respuesta']; ?>
                </div>
                <?php } ?>
                </div>
                <div class="responder color_<?php echo $preguntas[0]['id_categoria']; ?>" onclick="window.location='preguntas.php'">Responder</div>
            </div>
        </div>
        <div id="premios_index" onclick="window.location='premios.php'">
        	<span>Premios</span>
        	<article class="novedad">
                <img src="img/premios/<?php echo $premios[0]['imagen']; ?>" />
                <div class="info">
                    <div class="titulo"><?php echo $premios[0]['titulo']; ?></div>
                    <div class="texto"><?php echo $premios[0]['texto']; ?></div>
                </div>
            </article>
        </div>
        <div id="novedades_index" onclick="window.location='novedades.php'">
        	<span>Novedades</span>
        <?php
        	$fecha = explode('-',$novedades[0]['fecha']);
			$fecha = $fecha[2].'/'.$fecha[1].'/'.$fecha[0];
		?>
        	<article class="novedad">
                <img src="img/novedades/<?php echo $novedades[0]['imagen']; ?>" />
                <div class="info">
                    <div class="fecha"><?php echo $fecha; ?></div>
                    <div class="titulo"><?php echo $novedades[0]['titulo']; ?></div>
                    <div class="texto"><?php echo $novedades[0]['texto']; ?></div>
                </div>
            </article>
        </div>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
</div>
<script type="text/javascript" src="js/code.js"></script>
</body>
</html>