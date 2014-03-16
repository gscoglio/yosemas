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
        <section id="datos_usuario">
			<?php include('inc/perfil.php'); ?>
            <div id="filtrar_por_provincia">
                <div class="titulo">Filtrar por Provincia</div>
                <select id="provincia" name="provincia" size="1" onchange="var x = $('#categoria_val').val();categoria(x)">
                	<option value="0">Todas</option>
                    <?php
                    $provincias = get_provincias();
                    $tot_provincias = sizeof($provincias);
                    do{
                        static $i = 0;
                        $i++;
                        echo '<option value="'.$provincias[$i]['id'].'">'.utf8_decode($provincias[$i]['provincia']).'</option>';
                    }while($i <= $tot_provincias);
                    ?>
                </select>
            </div>
            <div id="filtrar_por_mes">
                <div class="titulo">Filtrar por Mes</div>
                <select id="filtrar_por_mes_select" name="mes" onchange="var x = $('#categoria_val').val();categoria(x)">
                	<option value="00">Todos</option>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>                    
                </select>
                <select id="filtrar_por_anio_select" name="anio" onchange="var x = $('#categoria_val').val();categoria(x)">
                	<option value="00">Todos</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>                        
                </select>
            </div>
        </section>
        <nav>
			<?php include('inc/btn_categorias.php'); ?>
        </nav>
        <section id="ranking">
        	<div id="ranking_grill">
            </div>
        </section>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
</div>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript">
var pagina = 'ranking';
$('#botonera_ppal #ranking a').css({
		'color': btn_select
});
categoria(1);
</script>
</body>
</html>