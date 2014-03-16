<?php
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos
//include('estado_preguntas.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Novedades</title>
		
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/jquery.dataTables_themeroller.css";
			@import "examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
		</style>
        
      <link type="text/css" href="css/estilo.css" rel="StyleSheet" />  
                
		<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
        
		<script type="text/javascript" charset="utf-8">
			function agregar_novedad(){
				window.location = 'nueva_novedad.php';	
			}
			function eliminar_novedad(id){
				var conf = confirm("Desea eliminar el post?");
				if(!conf)return false;
				window.location = 'operaciones.php?operacion=1&id='+id+'';
			}
			function editar_novedad(id){
				window.location = 'nueva_novedad.php?editar=1&id='+id+'';
			}
		</script>
        
       <?php
	   $query = "SELECT * FROM novedades ORDER BY fecha DESC";
	   $rs = mysql_query($query, $cnx);
	   $row_novedades = mysql_fetch_assoc($rs);
	   ?>
       <style type="text/css">
	    .bloque_novedades
		{
			width:900px;
			position:relative;
			margin:0 auto;	
			padding:10px 0;
			display:inline-block;
		}
		.bloque_novedades img
		{
			display:block;
			float:left;
			padding-right:10px;
		}
		.bloque_novedades .titulo
		{
			font-weight:bold;
			padding:5px 0;
		}
		.acciones
		{
			width:900px;
			display:block;
			border-bottom:1px dotted #222;
			margin-bottom:10px;
		}
		#nuevo
		{
			display:block;
			font-size:16px;
			margin:30px;
		}
	   </style>
	</head>
	
    <body>
	
   <?php include_once './cabecera.php'; ?>
        
    <input type="button" id="nuevo" name="nuevo" value="NUEVO POST" onClick="agregar_novedad()" />
    <div style="width:900px; margin-left:15%; position:relative;">
    <?php 
	do{
		$fecha = explode('-',$row_novedades['fecha']);
		$fecha = $fecha[2].'/'.$fecha[1].'/'.$fecha[0];
		echo '<div class="bloque_novedades">
			<img src="../img/novedades/'.$row_novedades['imagen'].'" />
			<div class="fecha">'.$fecha.'</div>
			<div class="titulo">'.$row_novedades['titulo'].'</div>
			<div class="texto">'.$row_novedades['texto'].'</div>
		</div>';
		echo '<div class="acciones"><input type="button" name="editar" value="Editar post" onClick="editar_novedad('.$row_novedades['id'].')" />
				<input type="button" name="eliminar" value="Eliminar post" onClick="eliminar_novedad('.$row_novedades['id'].')" /></div>';
	}while($row_novedades = mysql_fetch_assoc($rs));
	?>
    </div>
    <br><br>     
    <!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
    <!-- Fin del DIV pie -->
        
	</body>
</html>