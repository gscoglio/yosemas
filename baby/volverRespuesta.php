<?php
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos
include('estado_preguntas.php');
$idrespuesta=$_GET['idResp'];
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Preguntas Finalizadas</title>
		
	<link type="text/css" href="css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/jquery.ui.timepicker.css" type="text/css" />
	<link type="text/css" href="css/estilo.css" rel="stylesheet" />

	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>

	<script>	
		$(function(){
				
				//boton
				$( "input:submit, a, button", ".demo" ).button();
				$( "a", ".demo" ).click(function() { return true; });
				
			});
		</script>
        
	</head>
	
 
 
<body>

<?php include_once './cabecera.php'; ?>
 
<div class="demo">

<?php

$estadoFinalizada = 3;

// SELECCIONO TODO LOS DATOS DE LA RESPUESTA
$capturarIdRespuesta=mysql_query("SELECT * FROM respuestas WHERE id = $idrespuesta") or die("Problemas en el select:".mysql_error());

while($reg = mysql_fetch_array($capturarIdRespuesta)) {	
	$idpregunta= $reg['id_pregunta']; 

// SELECCIONO TODO LOS DATOS DE LA PREGUNTA
$capturarDatosPregunta=mysql_query("SELECT * FROM preguntas WHERE id = $idpregunta ") or die("Problemas en el select:".mysql_error());

while($reg = mysql_fetch_array($capturarDatosPregunta)) {
	
	$id_preg= $reg['id']; 
	$preg=$reg['pregunta']; 
	$punt=$reg['puntos']; 
	$id_categ = $reg['id_categoria'];
	$auto=$reg['autor']; 
	$fechaCom=date_time($reg['fecha_inicio']); 
	$fechaFi=date_time($reg['fecha_fin']);
	$est=$reg['estado'];
}

// SELECCIONO LOS USUARIOS QUE DEBO VOLVER 
$capturarGanadores = mysql_query("SELECT * FROM respuestas_usuarios WHERE id_respuesta = $idrespuesta") 
or die("Problemas en el select:".mysql_error());

while($reg = mysql_fetch_array($capturarGanadores)) {
	
	$idusuario= $reg['id_usuario'];  // echo "el id del usuario ganador es $idusuario <br>";
	
	// SELECCIONO EL PUNTAJE DEL USUARIO
	$capturarPuntos = mysql_query("SELECT * FROM puntaje WHERE id_usuario = $idusuario ORDER BY id_categoria") or die("Problemas en el select:".mysql_error());
		
		while($reg = mysql_fetch_array($capturarPuntos)) {
			$id_categoria = $reg['id_categoria'];
			if($id_categoria == $id_categ || $id_categoria == 1){
				$puntos = $reg['puntos'];
				$puntos = $puntos - $punt;
				$actuPuntos = mysql_query("UPDATE puntaje SET puntos=$puntos WHERE id_usuario=$idusuario AND id_categoria = $id_categoria") or die("Problemas en el update:".mysql_error());
			}		
		}
}

// actualiza el estado de la pregunta
$actuPregunta=mysql_query("UPDATE preguntas SET estado='".$estadoFinalizada."' WHERE id=$idpregunta") or die("Problemas en el update:".mysql_error());

// Actualiza la calificacion de la respuesta correcta
$actuEstado=mysql_query("UPDATE respuestas SET correcta=0 WHERE id = $idrespuesta") or die("Problemas en el update:".mysql_error());
}
?>


<center>
  <h1>¡La pregunta ha sido actualizada con éxito!</h1>
</center>
<center>
  <img src="Imagenes/images.jpg">
</center>

<DIV class="demo"  align="center">
    
    <table border="0" width="500">  
      
      <tr align="center">
           <td><h4>Para ver mas preguntas Respondidas presiona en el boton Ver Preguntas Respondidas. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="listarPreguntasRespondidas.php">Ver Preguntas Respondidas</a> </td>
      </tr>
      
      <tr align="center">
           <td><h4>Para volver al Menu Principal presiona en el boton Volver al Menu Principal. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="index.php">Volver al Menu Principal</a> </td>
      </tr>
      
    </table>
	
 </DIV>

</div>

 <br /><br />	
 <!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
 <!-- Fin del DIV pie -->

	</body>
</html>