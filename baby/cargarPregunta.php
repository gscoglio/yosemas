<?php 
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos
include('estado_preguntas.php');

// Esta funcion valida las 2 primeras respuestas 
function validaRespuesta($respuesta){	
	// No se puede ingresar una respuesta vacia
	if($respuesta=="")
		return false;
	// No se puede ingresar una respuesta con mas de 50 caracteres
	else if(strlen($respuesta) > 50)
		return false;	
	// Si todo esta bien devuelve true	
	else
		return true;
}

// Esta funcion valida las siguientes respuestas
function validaMasRespuesta($respu){	
	
	// No se puede ingresar una respuesta vacia
	if($respu=="")
		return true;
	// No se puede ingresar una respuesta con mas de 50 caracteres	
	if(strlen($respu) > 50)
		return false;
	// Si todo esta bien devuelve true			
	else
		return true;
}
 
// Esta funcion sirve para validar la pregunta 
function validaPregunta($pregunta){
	// Se inicializa con los signos de pregunta 
	if($pregunta=="¿?")
		return false;	
	// Debe tener como maximo 140 caracteres
	else if(strlen($pregunta) > 140)
		return false;
	// Verifica que solamente tenga los caracteres adecuados
//	else if(!preg_match("/^[0-9a-zA-Z[:space:]¿?áéíóúñü\.]+$/", $pregunta))
//		return false;
	// Si todo esta bien devuelve true
	else
		return true;
}

// Esta funcion sirve para validar los puntos
function validaPuntos($poin){
	// Debe tener como maximo 4 caracteres
	if(strlen($poin) > 4)
		return false;
	// Solamente debe tener numeros
	else if(!preg_match("/^[0-9]+$/", $poin))
		return false;
	// Si todo esta bien devuelve true
	else
		return true;
}

// Esta funcion sirve para validar la categoria
function validaCategoria($categorie){
	//No hay nada seleccionado
	if($categorie == "0")
		return false;
	// Si todo esta bien devuelve true
	else
		return true;
}

// Esta funcion sirve para saber si queda la fecha u hora vacia
function validaFechaYHora($datos){
	// No se puede ingresar una fecha u hora vacia
	if($datos=="")	
		return false;
	else
		return true;
}


// Esta funcion sirve para capturar la fecha de hoy
function fechaDeHoy(){	
	global $fechaHoy;
	$fechaHoy = date("d/m/Y H:i");
}

// Esta fucion sirve para validar la cantidad de respuestas que ingreso el usuario 
function validaCantidadRespuestas(){
	global $contador;
	$contador=0;
		
	if (!($_POST['respuesta1'])==""){
	$contador=$contador+1;
		
		if (!($_POST['respuesta2'])==""){
		$contador=$contador+1;}
	
			if (!($_POST['respuesta3'])==""){
			$contador=$contador+1; }
				 
				 if (!($_POST['respuesta4'])==""){
				 $contador=$contador+1; }
				
					if (!($_POST['respuesta5'])==""){
					$contador=$contador+1; }
		
						if (!($_POST['respuesta6'])==""){
						$contador=$contador+1; }
		
							if (!($_POST['respuesta7'])==""){
							$contador=$contador+1; }
		
								if (!($_POST['respuesta8'])==""){
								$contador=$contador+1;}
	}			
}


// Variables para comprobar que no exista ningun error 
	$pregunta=""; $puntos=""; $categoria=""; $desde=""; $hasta=""; 
	$resp1=""; $resp2=""; $resp3=""; $resp4=""; $resp5=""; $resp6=""; $resp7=""; $resp8="";
	
//Variables para guardar los datos 
	$question="¿?"; $point=""; $category=""; $from=""; $to=""; $start=""; $end="";
	$reply1=""; $reply2=""; $reply3=""; $reply4=""; $reply5=""; $reply6="";$reply7=""; $reply8=""; 	

// Verifica que se halla apretado el boton
if(isset($_POST['cargarPregunta'])){
	
		if(!validaPregunta($_POST['pregunta']))
			$pregunta = "error";
		if(!validaPuntos($_POST['puntos']))
			$puntos = "error";
		if(!validaCategoria($_POST['categoria']))
			$categoria = "error";
		if(!validaFechaYHora($_POST['from']))
			$desde = "error";
		if(!validaFechaYHora($_POST['to']))
			$hasta = "error";
		if(!validaRespuesta($_POST['respuesta1']))
			$resp1 = "error";
		if(!validaRespuesta($_POST['respuesta2']))
			$resp2 = "error";
		if(!validaMasRespuesta($_POST['respuesta3']))
			$resp3 = "error";
		if(!validaMasRespuesta($_POST['respuesta4']))
			$resp4 = "error";
		if(!validaMasRespuesta($_POST['respuesta5']))
			$resp5 = "error";
		if(!validaMasRespuesta($_POST['respuesta6']))
			$resp6 = "error";
		if(!validaMasRespuesta($_POST['respuesta7']))
			$resp7 = "error";
		if(!validaMasRespuesta($_POST['respuesta8']))
			$resp8 = "error";	

			
		$question=$_POST['pregunta'];
		$point=$_POST['puntos'];
		$category=$_POST['categoria'];
		$autor=$_POST['autor'];
		$from=$_POST['from'];
		$to=$_POST['to'];
		$start=$_POST['horaStart'];
		$end=$_POST['horaEnd'];
		$reply1=$_POST['respuesta1'];
		$reply2=$_POST['respuesta2'];
		$reply3=$_POST['respuesta3'];
		$reply4=$_POST['respuesta4'];
		$reply5=$_POST['respuesta5'];
		$reply6=$_POST['respuesta6'];
		$reply7=$_POST['respuesta7'];
		$reply8=$_POST['respuesta8'];
		
		fechaDeHoy();
		validaCantidadRespuestas();
		
		$fechaComienzo="$from"." "."$start";
		$fechaFin="$to"." "."$end";
		
		
	if($pregunta != "error" && $puntos != "error" && $categoria != "error" && $desde != "error" && $hasta != "error" && $resp1 != "error" 
	&& $resp2 != "error" && $resp3 != "error" && $resp4 != "error" && $resp5 != "error" && $resp6 != "error" && $resp7 != "error" && $resp8 != "error")	
					
					$mostrarRespuestas = 1;					
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="css/estilo.css" type="text/css">
<link rel="stylesheet" href="css/custom-theme/jquery-ui-1.8.21.custom.css"  type="text/css"/>
<link rel="stylesheet" href="css/jquery.ui.timepicker.css" type="text/css" />

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="js/jquery.ui.timepicker.js"></script>

<script type="text/javascript">

			$(function(){
				
				var dates = $( "#from, #to" ).datepicker({
			//	defaultDate: "+1w",
				changeMonth: true,				
			//	showOn: 'both',
			//	buttonImage: 'Imagenes/calendar.gif',
			//	buttonImageOnly: true,
				numberOfMonths: 2,
				
				onSelect: function( selectedDate ) {
			    var option = this.id == "from" ? "minDate" : "maxDate",	
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
				}
				});
	
				
				
				$('#horaStart').timepicker({
				//	showOn: 'button',
        		//	button: '.timepicker_button_trigger',
					hourText: 'Horas',
					minuteText: 'Minutos',
					}); 	

				$('#horaEnd').timepicker({
					hourText: 'Horas',
					minuteText: 'Minutos',
					});
				
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
				
				// Slider
				$('#slider').slider({
					range: true,
					values: [17, 67]
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

<?php

$seleccionado1 =""; $seleccionado2 =""; $seleccionado3 ="";
$seleccionado4 =""; $seleccionado5 ="";

if(isset($_POST['cargarPregunta'])){
	if($_SERVER['REQUEST_METHOD']=='POST') {
		$seleccionado1 = $_POST['categoria'];
	}
}
?>



<?php if(!isset($mostrarRespuestas)):?>

<div class="demo" align="center"> 

<h2>Carga de Pregunta</h2>

<FORM ACTION="cargarPregunta.php" METHOD="post">
  <table cellspacing="3" cellpadding="3">
    
    <tr>
      <td align="right">Pregunta:</td>
      <td colspan="5"><textarea name="pregunta" rows="2" cols="70" maxlength="140" style="font:Trebuchet MS"><?php echo(trim($question)); ?></textarea> </td>
    </tr>
    <tr>
       
      <td align="right">Puntos:</td>
      <td ><INPUT TYPE="text" NAME="puntos" ID="puntos" SIZE=10 MAXLENGTH=4 value="<?php echo(trim($point)); ?>"></td>
      
      <td align="right">Categoria:</td>
      <td><select name = "categoria" >      
         <?php 
			$datosCategoria = array("Categorias:", "Deportes", "Politica y Economia", "Espectaculo", "Miscelanea");     
	 		for($i=0; $i<count($datosCategoria); $i++) {
            	if($i==$seleccionado1) {
               		echo "<option value='".$i."' selected>".$datosCategoria[$i]."</option>";
            	}
            	else {
               		echo "<option value='".$i."'>".$datosCategoria[$i]."</option>";
            	}
         	}
		//	echo "$seleccionado1";  
?>
          
        </select></td>
        
      <td align="right">Autor:</td>
      <td width="100"><INPUT TYPE="text" NAME="autor" SIZE=15 MAXLENGTH=15 VALUE="Yo Se +"></td>
    </tr>
    
    <tr>
      <td colspan="2" align="center">Fecha de Comienzo:</td>
      <td ><input type="text" id="from" name="from" size="15" value="<?php echo(trim($from)); ?>"></td>
      <td align="center">Fecha de Fin:</td>
      <td colspan="2"><input type="text" id="to" name="to" size="15" value="<?php echo(trim($to)); ?>"></td>
    </tr>
    
     <tr>
      <td colspan="2" align="center">Hora de Comienzo:</td>
      <td >
      
      <input type="text" id="horaStart" name="horaStart" size="15" value="<?php echo(trim($start)); ?>">   
<!--  <div class='timepicker_button_trigger'
             style="width: 18px; height:18px; background: url(Imagenes/reloj.png); display: inline-block; 
             border-radius: 2px; border: 1px solid #222222;"></div> -->
      </td>
      <td align="center">Hora de Fin:</td>
      <td colspan="2"><input type="text" id="horaEnd" name="horaEnd" size="15" value="<?php echo(trim($end)); ?>">
<!--  <div class='timepicker_button_trigger'
             style="width: 18px; height:18px; background: url(Imagenes/reloj.png); display: inline-block;
             border-radius: 2px; border: 1px solid #222222;"></div> -->
      </td>
    </tr>
    
    </table>
    
    <h2>Carga de Respuestas</h2>
    
    <table cellpadding="3" cellspacing="3">
    
    <tr> 
    <td>Respuesta 1:</td> 
    <td><INPUT TYPE="text" NAME="respuesta1" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply1)); ?>"> </td> 
    <tr>
    
     <tr> 
    <td>Respuesta 2:</td> 
    <td><INPUT TYPE="text" NAME="respuesta2" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply2)); ?>"></td> 
    <tr>
    
    <tr>  
    <td>Respuesta 3:</td> 
    <td><INPUT TYPE="text" NAME="respuesta3" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply3)); ?>"></td> 
    <tr>
    
    <tr> 
    <td>Respuesta 4:</td> 
    <td><INPUT TYPE="text" NAME="respuesta4" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply4)); ?>"></td> 
    <tr>
    
     <tr> 
    <td>Respuesta 5:</td> 
    <td><INPUT TYPE="text" NAME="respuesta5" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply5)); ?>"></td> 
    <tr>
    
     <tr> 
    <td>Respuesta 6:</td> 
    <td><INPUT TYPE="text" NAME="respuesta6" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply6)); ?>"></td> 
    <tr>
    
     <tr> 
    <td>Respuesta 7:</td> 
    <td><INPUT TYPE="text" NAME="respuesta7" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply7)); ?>"></td> 
    <tr>
    
    <tr> 
    <td>Respuesta 8:</td> 
    <td><INPUT TYPE="text" NAME="respuesta8" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply8)); ?>"></td>
    
    <tr>
    <td colspan="2" align="center"><input name="cargarPregunta" type="submit" class="boton" value="Cargar Pregunta" /></td>
    </tr>
  </table>
</FORM>

<br>


<?php if(isset($_POST['cargarPregunta'])){ ?>
	
	<?php  if(!validaPregunta($_POST['pregunta'])) { ?>
            <div id="dialog-message" title="ERROR EN LA CARGA DE LA PREGUNTA" align="center"> 
			  No puedes ingresar una pregunta vacia, caracteres extraños o mas de 140 caracteres. </div>         
	
	 <?php } else if(!validaPuntos($_POST['puntos'])) { ?>
     		<div id="dialog-message" title="EROR EN LA CARGA DE LOS PUNTOS" align="center"> 
			  No puedes dejar el campo Puntos vacio o solamente debes ingresar numeros. </div>
            
	 <?php } else if(!validaCategoria($_POST['categoria'])) { ?>
     		<div id="dialog-message" title="ERROR EN LA CARGA DE LA CATEGORIA" align="center"> 
			  Debes elegir una categoria. </div>
	
	<?php } else if(!validaFechaYHora($_POST['from'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA FECHA DE COMIENZO" align="center"> 
			  Debes elegir una fecha de comienzo. </div>		
	
	<?php } else if(!validaFechaYHora($_POST['to'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA FECHA DE FIN" align="center"> 
			  Debes elegir una fecha de fin. </div>
    
    <?php } else if(!validaFechaYHora($_POST['horaStart'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA HORA DE COMIENZO" align="center"> 
			  Debes elegir una hora de comienzo. </div>
    
    <?php } else if(!validaFechaYHora($_POST['horaEnd'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA HORA DE FIN" align="center"> 
			  Debes elegir una hora de fin. </div>
			
	<?php } else if(!validaRespuesta($_POST['respuesta1'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA PRIMER RESPUESTA" align="center"> 
			  Por favor ingresa la primer respuesta. </div>	
	
	<?php } else if(!validaRespuesta($_POST['respuesta2'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA SEGUNDA RESPUESTA" align="center"> 
			 Por favor ingresar la segunda respuesta. </div>
	
	<?php } else if(!validaMasRespuesta($_POST['respuesta3'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA TERCER RESPUESTA" align="center"> 
			 Debes ingresar la tercer respuesta. </div>
	
	<?php } else if(!validaMasRespuesta($_POST['respuesta4'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA CUARTA RESPUESTA" align="center"> 
			 Debes ingresar la cuarta respuesta. </div>
	
	<?php } else if(!validaMasRespuesta($_POST['respuesta5'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA QUINTA RESPUESTA" align="center"> 
			 Debes ingresar la quinta respuesta. </div>
	
	<?php } else if(!validaMasRespuesta($_POST['respuesta6'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA SEXTA RESPUESTA" align="center"> 
			 Debes ingresar la sexta respuesta. </div>
	
	<?php } else if(!validaMasRespuesta($_POST['respuesta7'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA SEPTIMA RESPUESTA" align="center"> 
			 Debes ingresar la septima respuesta. </div>
	
	<?php } else if(!validaMasRespuesta($_POST['respuesta8'])) { ?>
    		<div id="dialog-message" title="ERROR EN LA CARGA DE LA OCTAVA RESPUESTA" align="center"> 
			 Debes ingresar la octava respuesta. </div>	
	<?php }?>
	

<?php } // cierra el if de la linea 262 ?>

<?php else: 

	$estado=1;
	$calificacion=0;
	$votos=0;
	
	$pregunta = mysql_real_escape_string($question);  // Elimina caracteres especiales de una cadena
    $pregunta = trim($pregunta); 
	
	$reg = mysql_query("INSERT INTO preguntas (pregunta, puntos, categoria, autor, fechaCreacion, fechaComienzo, fechaFin, Estado) VALUES 
	('".$question."', '".$point."', '".$category."', '".$autor."', '".$fechaHoy."', '".$fechaComienzo."', '".$fechaFin."', '".$estado."')"); 
	
	// selecciono el ultimo id ingresado 
	$idPregunta= mysql_insert_id();
  //  echo "id de la ultima pregunta=". $idPregunta . "<br>";
			
	$vectorRespuestas = array($reply1,$reply2,$reply3,$reply4,$reply5,$reply6,$reply7,$reply8);
	
	for ($i = 0; $i < 8; $i++){
		
		//Pregunta si la respuesta tiene algo
		if (!$vectorRespuestas[$i]==""){
			 
		$regResp = mysql_query("INSERT INTO respuestas (idPregunta,respuesta,calificacion,cantidadVotos) VALUES 
		('".$idPregunta."', '".$vectorRespuestas[$i]."', '".$calificacion."', '".$votos."')");	
			
		}
		//Si no tiene nada no hace nada	
		else {
			}
	}
	
	
	
//	foreach ($_POST as $indice => $valor){
//		echo "$indice: $valor <br>";
//	}
?>

<br>
<center>
  <h1>¡La pregunta ha sido guardada con éxito!</h1>
</center>
<center>
  <!-- <img src="Imagenes/tilde.jpg"> --> <br  />
</center>


<DIV class="demo" align="center">

 <table border="0" width="500">
      
      <tr align="center">
           <td><h4>Para cargar otra pregunta presiona en el boton Cargar otra Pregunta. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="cargarPregunta.php">Cargar otra Pregunta</a> </td>
      </tr>
      
    </table>

	</DIV>
<?php
endif;
?>

</div>

</html>