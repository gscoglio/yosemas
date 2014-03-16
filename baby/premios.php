<?php
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos
//include('estado_preguntas.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Premios</title>
		
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/jquery.dataTables_themeroller.css";
			@import "examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
			
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
        
      <link type="text/css" href="css/estilo.css" rel="StyleSheet" />  
                
		<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
        
		<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {
				$('#example').dataTable({
					
					"bJQueryUI": true,
					"bPaginate": false,
				 
				 "oLanguage": {
						 
						"sZeroRecords": "No hay preguntas para mostrar",
	           			"sInfo": "Mostrando _TOTAL_ respuestas",
						"sSearch": "Buscar:",					
					}			
								
				});
			} );
		</script>
        
        <script type="text/javascript" charset="utf-8">
			function agregar_premio(){
				window.location = 'nuevo_premio.php';	
			}
			function eliminar_premio(id){
				var conf = confirm("Desea eliminar el premio?");
				if(!conf)return false;
				window.location = 'operaciones.php?operacion=2&id='+id+'';
			}
			function editar_premio(id){
				window.location = 'nuevo_premio.php?editar=1&id='+id+'';
			}
		</script>
	</head>
	
    <body>
	
    <?php include_once './cabecera.php'; ?>
        
    <div id="premios">
    	<?php 
		if(isset($_GET['error']) && $_GET['error'] == 0){
		?>
			<span style="font-size:16px;">Los cambios fueron realizados con &eacute;xito</span>
            <br /><br />
			<a style="font-size:18px; font-weight:bold;" href="premios.php">Volver a premios</a>
        <?php
		}
		else{
		$query = "SELECT * FROM premios ORDER BY id DESC";
	   $rs = mysql_query($query, $cnx);
	   $premios = mysql_fetch_assoc($rs); ?>
        <br />
        <input type="button" id="nuevo" name="nuevo" value="NUEVO PREMIO" onClick="agregar_premio()" />
        <div style="width:900px; margin-left:15%; position:relative;">
			<?php 
			$i=0;
            do{
                echo '<div class="bloque_novedades">
                    <img src="../img/premios/'.$premios['imagen'].'" />
                    <div class="titulo">'.$premios['titulo'].'</div>
                    <div class="texto">'.$premios['texto'].'</div>
                </div>';
                echo '<div class="acciones"><input type="button" name="editar" value="Editar premio" onClick="editar_premio('.$premios['id'].')" />
                        <input type="button" name="eliminar" value="Eliminar premio" onClick="eliminar_premio('.$premios['id'].')" /></div>';
            }while($premios = mysql_fetch_assoc($rs));
            ?>
        </div>
        <?php } ?>
        <br /> <br /> <br />
    </div>    
    <!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
    <!-- Fin del DIV pie -->
        
	</body>
</html>