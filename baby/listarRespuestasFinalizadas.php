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
    
    <div id="cabecera">
      <table width="100%">        
    <tr>
      <td width="15%">
      	<div id="logo">	<a href="index.php"> <img src="img/logo.png" alt="Yo sé más que vos" title="Yo sé más que vos" /> </a> </div>
      </td>
      <td width="77%">
      	 
       <table align="center" cellpadding="15px" >
           	<tr>
                 <td>  
                 <div id="menu2">   
                 <table>
                 <tr>
                 	<td><li class="mp"><a href="index.php">Cargar Una Pregunta</a> </td>
                    <td><li class="mp"><a href="listarPreguntasCreadas.php">Ver Preguntas Creadas</a></td>
                    <td><li class="mp"><a href="listarPreguntasPublicadas.php">Ver Preguntas Publicadas</a></td>
                    <td><li class="mp"><a href="listarPreguntasFinalizadas.php">Ver Preguntas Finalizadas</a></td>
                 	<td><li class="mp"><a href="novedades.php">Novedades</a></td>
                 </tr>   
                 <tr>   
                    <td><li class="mp"><a href="listarPreguntasRespondidas.php">Ver Preguntas Respondida</a></td>
                    <td><li class="mp"><a href="verUsuarios.php">Ver Usuarios</a></td>
                    <td><li class="mp"><a href="verTorneos.php">Ver Torneos de Amigos</a></td>
                    <td><li class="mp"><a href="admin.php">Crear un Administrador</a></td>
                    <td><li class="mp"><a href="premios.php">Premios</a></td>
          		</tr> 
       			</table>
                </div>
              	</td>
            </tr>
        </table>
     </td>
    
     <td width="8%">
		<div id="redesSociales">
            <a href="http://www.facebook.com" target="_blank">
            <img src="img/face1.png" alt="Seguinos en Facebook" title="Seguinos en Facebook"  onmouseover="this.src='img/face2.png';" 
            onmouseout="this.src='img/face1.png';"/> 
            </a>
            <a href="https://twitter.com/yosemasquevos" target="_blank">
            <img src="img/twitter1.png" alt="Seguinos en Twitter" title="Seguinos en Twitter" onmouseover="this.src='img/twitter2.png';" 
            onmouseout="this.src='img/twitter1.png';"/> 
            </a> 
         </div>     
     </td>
    </tr>
   </table>
 	</div>
    
    <div id="barra">
    <table border="0" width="100%" height="42px">
    	<tr>
            <td width="20%"> <div id="user"> Administrador  </div> </td>
            <td width="60%"> </td>		
            <td width="20%"> <div id="exit"> <a href="logout.php">Salir</a> </div> </td>
    	</tr>
    </table>
    </div>
    
    
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