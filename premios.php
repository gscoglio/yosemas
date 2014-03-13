<?php
	require_once('cnx.php');
	require_once('funciones.php');
	require_once('seguridad.php');
	
	$premios = get_premios();
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
    	<section id="novedades">
        <?php 
		$i = 0;
		foreach($premios as $key){
		?>
        	<article class="novedad">
                <img src="img/premios/<?php echo $key['imagen']; ?>" />
                <div class="info">
                    <div class="titulo"><?php echo $key['titulo']; ?></div>
                    <div class="texto"><?php echo $key['texto']; ?></div>
                </div>
            </article>
        <?php
		$i++;
		};
		?>
        </section>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
</div>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript">
$('#botonera_ppal #premios a').css({
		'color': btn_select
});
</script>
</body>
</html>