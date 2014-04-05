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
            
        </section>
        <nav>
			<?php include('inc/btn_categorias.php'); ?>
        </nav>
        <section id="ranking">
            <div id='filtros'>
                <label>Provincia:</label>
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
                <label id="filtrar_por_mes_label">Mes:</label>
                <?php $mesActual = date("m");?>
                <select id="filtrar_por_mes_select" name="mes" onchange="var x = $('#categoria_val').val();categoria(x);">
                    <option value="00">Todos</option>
                    <option value="01" <?php if ($mesActual == "01") {echo "selected";} ?>>Enero</option>
                    <option value="02" <?php if ($mesActual == "02") {echo "selected";} ?>>Febrero</option>
                    <option value="03" <?php if ($mesActual == "03") {echo "selected";} ?>>Marzo</option>
                    <option value="04" <?php if ($mesActual == "04") {echo "selected";} ?>>Abril</option>
                    <option value="05" <?php if ($mesActual == "05") {echo "selected";} ?>>Mayo</option>
                    <option value="06" <?php if ($mesActual == "06") {echo "selected";} ?>>Junio</option>
                    <option value="07" <?php if ($mesActual == "07") {echo "selected";} ?>>Julio</option>
                    <option value="08" <?php if ($mesActual == "08") {echo "selected";} ?>>Agosto</option>
                    <option value="09" <?php if ($mesActual == "09") {echo "selected";} ?>>Septiembre</option>
                    <option value="10" <?php if ($mesActual == "10") {echo "selected";} ?>>Octubre</option>
                    <option value="11" <?php if ($mesActual == "11") {echo "selected";} ?>>Noviembre</option>
                    <option value="12" <?php if ($mesActual == "12") {echo "selected";} ?>>Diciembre</option>                    
                </select>
                <label id="filtrar_por_anio_label">Año:</label>
                <?php $anioActual = date("Y");?>
                <select id="filtrar_por_anio_select" name="anio" onchange="var x = $('#categoria_val').val();categoria(x)">
                    <option value="00">Todos</option>
                    <option value="2014" <?php if ($anioActual == "2014") {echo "selected";} ?>>2014</option>
                    <option value="2015" <?php if ($anioActual == "2015") {echo "selected";} ?>>2015</option>
                    <option value="2016" <?php if ($anioActual == "2016") {echo "selected";} ?>>2016</option>                        
                </select>
            </div>
            <div id="ranking_grill"></div>
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