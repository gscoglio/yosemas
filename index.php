<?php
	require_once('cnx.php');
	require_once('funciones.php');
	require_once('seguridad.php');

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
<?php include_once("analyticstracking.php") ?>
<div id="contenido">
	<header id="header">
    	<?php include('inc/header.php'); ?>
    </header>
    <div id="banda">
		<?php include('inc/banda.php'); ?>
    </div>
    <div id="centro">
        <div id="subtitulo">&iquest;Sos el que m&aacute;s sabe de todo? &iexcl;Demostralo!</div>
        <br />
        <div style="width: 450px; float: left">
            <a class="twitter-timeline" href="https://twitter.com/yosemasquevos" data-widget-id="438465236719239168">Tweets por @yosemasquevos</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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