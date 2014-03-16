<?php
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos
include('estado_preguntas.php');
$idPregunta=$_GET['idPreg']; 
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/jquery.dataTables_themeroller.css";
			@import "examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
		</style>
        
        <link type="text/css" href="css/estilo.css" rel="StyleSheet" />
                
		<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
		
		<script type="text/javascript" charset="utf-8">
			
			$(function(){
			//$(document).ready(function() {
				
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
	</head>
	
    <body>
    
    <?php include_once './cabecera.php'; ?>
    
		<div class="demo" style="width:100%">
        
        	<div style="display:inline; float:right"> <a href="listarPreguntasFinalizadas.php">Volver</a> </div> 
			
            <h2 align="center"> Lista de Respuestas a Finalizar </h2>
			
			 
			<div class="demo_jui">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
        	
			<th>Numero de la Respuesta</th>
            <th>Respuesta</th>
			<th>Cantidad Votos</th>
            <th>Elegir como la Correcta</th>
            
			
		</tr>
	</thead>
    
   
	<tbody>

<?php

$registros=mysql_query("SELECT * FROM respuestas WHERE id_pregunta= $idPregunta") or die("Problemas en el select:".mysql_error());
$numRespuesta=0;

while($reg = mysql_fetch_array($registros)) {
	
	$id_resp= $reg['id'];
	$id_preg= $reg['id_pregunta'];
	$respuesta=$reg['respuesta'];
	$califica=$reg['correcta'];
	$cantVotos=$reg['total_votos'];
	$numRespuesta=$numRespuesta+1;

?>

	<tr class="gradeC">
			
            <td class="center"><?php echo $numRespuesta ?></td>
            <td class="center" width="600"> <?php echo $respuesta ?></td>
            <td class="center"><?php echo $cantVotos ?></td>
            <td class="center"><a href="actualizarRespuesta.php?idResp=<?php echo $id_resp; ?>">[Elegir]</a></td>
            			
		</tr>
        
<?php }?>
		
	</tbody>
</table>	
			</div>
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