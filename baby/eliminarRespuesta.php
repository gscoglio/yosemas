<?php 
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos
include('estado_preguntas.php');
$idRespuesta=$_GET['idResp'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eliminar Respuesta</title>

<link type="text/css" href="css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<link rel="stylesheet" href="css/jquery.ui.timepicker.css" type="text/css" />
<link type="text/css" href="css/estilo.css" rel="stylesheet" />

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
        
        <script type="text/javascript">

			$(function(){	
				
				// Accordion
				$("#accordion").accordion({ header: "h3" });
	
				// Tabs
				$('#tabs').tabs();
				
				//boton
				$( "input:submit, a, button", ".demo" ).button();
				$( "a", ".demo" ).click(function() { return true; });

				// Dialog			
				$('#dialog').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});
				
				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				
				$( "#dialog-message" ).dialog({
					modal: true,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
				
			});
		</script>


</head>

<?php include_once './cabecera.php'; ?>

<div class="demo" align="center">

<?php 

// echo $idRespuesta;

if ($idRespuesta==""){ ?>

<h1>¡No Puedes Eliminar una Respuesta Vacia!</h1>
  <img src="Imagenes/aviso.jpg">

  <DIV class="demo"  align="center">
    
    <table border="0" width="500">  
      
      <tr align="center">
           <td><h4>Para ver mas preguntas creadas presiona en el boton Ver Preguntas Creadas. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="listarPreguntasCreadas.php">Ver Preguntas Creadas</a> </td>
      </tr>
      
      <tr align="center">
           <td><h4>Para volver al Menu Principal presiona en el boton Volver al Menu Principal. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="index.php">Volver al Menu Principal</a> </td>
      </tr>
      
      <tr align="center">
           <td><h4>Para volver a la pregunta anterior presiona en el boton Volver </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="<?php $_SERVER["HTTP_REFERER"]?>">Volver</a> </td>
      </tr>
      
    </table>
	
 </DIV>


<?php		
}

else { 
	
	$eliminarRespuesta=mysql_query("UPDATE respuestas SET id_pregunta=0 WHERE id=$idRespuesta") or die("Problemas en el update:".mysql_error());
?>

  <h1>¡La Respuesta ha sido eliminada con éxito!</h1>
  <img src="Imagenes/images.jpg">

	<DIV class="demo"  align="center">
    
    <table border="0" width="500">  
      
      <tr align="center">
           <td><h4>Para ver mas preguntas creadas presiona en el boton Ver Preguntas Creadas. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="listarPreguntasCreadas.php">Ver Preguntas Creadas</a> </td>
      </tr>
      
      <tr align="center">
           <td><h4>Para volver al Menu Principal presiona en el boton Volver al Menu Principal. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="index.php">Volver al Menu Principal</a> </td>
      </tr>
      
      <tr align="center">
           <td><h4>Para volver a la pregunta anterior presiona en el boton Volver </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="<?php $_SERVER["HTTP_REFERER"]?>">Volver</a> </td>
      </tr>
      
    </table>
	
 </DIV>

<?php
}
?>

</div>

 <br /><br />	
 <!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
    <!-- Fin del DIV pie -->

</html>