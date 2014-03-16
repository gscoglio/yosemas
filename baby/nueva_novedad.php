<?php
include('cnx.php');

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
        
       <style type="text/css">
	   #bloque_novedad
	   {
		   position:relative;
		   width:100%;
	   }
	    #form_nueva_novedad
		{
			width:400px;
			position:relative;
			margin:0 auto;	
			padding:10px 0;
		}
		#form_nueva_novedad .block
		{
			padding:10px 0;
		}
	   </style>
	</head>
	
    <body>
	
    <?php include_once './cabecera.php'; ?>
        
    <div id="bloque_novedad">
    <br>
    	<a href="novedades.php" style="margin:30px; font-weight:bold;"><< Volver a Novedades</a>
        <?php 
		if(isset($_GET['editar']) && $_GET['editar'] == 1){
			$id = $_GET['id'];
			$query = "SELECT * FROM novedades WHERE id = $id";
			$rs = mysql_query($query,$cnx);
			$row_datos = mysql_fetch_assoc($rs);
		?>
        <form id="form_nueva_novedad" name="form_nueva_novedad" enctype="multipart/form-data" action="guardar_novedad.php?accion=2" method="post">       
            <div class="block">Fecha: <input type="text" id="fecha" name="fecha"  value="<?php echo $row_datos['fecha']; ?>" /> (yyyy-mm-dd)</div>
            <div class="block">T&iacute;tulo: <input type="text" id="titulo" name="titulo" style="font-size:16px; width:400px;" value="<?php echo $row_datos['titulo']; ?>" /></div>
            <div class="block">Texto: <textarea rows="10" cols="70" id="texto" name="texto"><?php echo $row_datos['texto']; ?></textarea></div>
            <div class="block">Cambiar Imagen: <input type="file" name="foto" id="foto" /></div>
            <input type="hidden" id="foto_orig" name="foto_orig" value="<?php echo $row_datos['imagen']; ?>" />
            <input type="hidden" id="id" name="id" value="<?php echo $row_datos['id']; ?>" />
            <input type="submit" name="enviar" id="enviar" value="Guardar" />
        </form> 
        <?php
        }
        else{
		?>
        <form id="form_nueva_novedad" name="form_nueva_novedad" enctype="multipart/form-data" action="guardar_novedad.php?accion=1" method="post">       
            <div class="block">Fecha: <input type="text" id="fecha" name="fecha" /> (yyyy-mm-dd)</div>
            <div class="block">T&iacute;tulo: <input type="text" id="titulo" style="font-size:16px; width:400px;" name="titulo" /></div>
            <div class="block">Texto: <textarea rows="10" cols="70" id="texto" name="texto"></textarea></div>
            <div class="block">Seleccionar Imagen: <input type="file" name="foto" id="foto" /></div>
            <input type="submit" name="enviar" id="enviar" value="Guardar" />
        </form> 
        <?php
        }
		?>
    </div>
    <br><br>     
    <!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
    <!-- Fin del DIV pie -->
        
    <script type="text/javascript">
		$('#form_nueva_novedad #foto').change(function() { 
		$.ajax({
		type: "POST",
		url: "imagen.php",
		data: { 'operacion': 3, 'id_pregunta': id_pregunta, 'id_respuesta': id_respuesta, 'user': id_usuario }
		}).done(function() {
			
		}); 
		$('#marco_foto img').attr('src','');
	});
	</script>
	</body>
</html>