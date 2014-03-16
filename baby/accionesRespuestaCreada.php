<?php 
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos
include('estado_preguntas.php');
$idPregunta=$_GET['idPreg'];
// echo $idPregunta;


$reply1[1]=""; $reply2[1]=""; $reply3[1]=""; $reply4[1]=""; $reply5[1]=""; $reply6[1]="";$reply7[1]=""; $reply8[1]=""; 
$id1[1]="";    $id2[1]="";    $id3[1]="";    $id4[1]="";    $id5[1]="";    $id6[1]="";   $id7[1]="";    $id8[1]="";

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
	if($pregunta=="")
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
	$fechaHoy = date("d-m-Y H:i:s");
}

// Esta fucion sirve para validar la cantidad de respuestas que ingreso el usuario 
function validaCantidadRespuestas(){
	
	global $contador;
	$contador=1;
	
	// echo "entra a esta funcion";
		
	if (!($_POST['respuesta1'])==""){
		$contador=$contador+1; 
	//	echo "Entra a 1, Valor del contador: $contador ";
	} 
		
		if (!($_POST['respuesta2'])==""){
			$contador=$contador+1;
		//	echo "<br> Entra a 2, Valor del contador: $contador ";
		} 
	
			if (!($_POST['respuesta3'])==""){
				$contador=$contador+1; 
			//	echo "<br> Entra a 3, Valor del contador: $contador ";
			} 
				 
				 if (!($_POST['respuesta4'])==""){
				 	$contador=$contador+1; 
				 //	echo "<br> Entra a 4, Valor del contador: $contador ";	
				}
				
					if (!($_POST['respuesta5'])==""){
						$contador=$contador+1; 
					//	echo "<br> Entra a 5, Valor del contador: $contador ";
					}
		
						if (!($_POST['respuesta6'])==""){
							$contador=$contador+1; 
						//	echo "<br> Entra a 6, Valor del contador: $contador ";	
						}
		
							if (!($_POST['respuesta7'])==""){
								$contador=$contador+1; 
							//	echo "<br> Entra a 7, Valor del contador: $contador ";	
							}
		
								if (!($_POST['respuesta8'])==""){
									$contador=$contador+1;
								//	echo "<br> Entra a 8, Valor del contador: $contador ";	
								}
}


// Variables para comprobar que no exista ningun error 
	$pregunta=""; $puntos=""; $categoria=""; $desde=""; $hasta=""; 
	$resp1=""; $resp2=""; $resp3=""; $resp4=""; $resp5=""; $resp6=""; $resp7=""; $resp8="";
	
// Recuperamos los datos de la pregunta
$datosPregunta=mysql_query("SELECT Pr.*, Ca.categoria FROM preguntas Pr
								INNER JOIN categorias Ca ON Ca.id = Pr.id_categoria 
								WHERE Pr.id = $idPregunta") or die("Problemas en el select:".mysql_error());
			
			while($reg = mysql_fetch_array($datosPregunta)) {
				$id_preg= $reg['id']; 
				$preg=$reg['pregunta']; 
				$punt=$reg['puntos']; 
				$cate=$reg['categoria']; 
				$id_categ = $reg['id_categoria'];
				$auto=$reg['autor']; 
				$fechaCom=date_time($reg['fecha_inicio']); 
				$fechaFi=date_time($reg['fecha_fin']);
				$est=$reg['estado'];
			}

			list($Fecha1,$Tiempo1) = explode(" ",$fechaCom);
			list($Fecha2,$Tiempo2) = explode(" ",$fechaFi);

// Recuperamos las respuestas de la pregunta
$datosRespuesta=mysql_query("SELECT * FROM respuestas WHERE id_pregunta= $idPregunta") or die("Problemas en el select:".mysql_error());
$i=1;

while($reg = mysql_fetch_array($datosRespuesta)) {
	
	$id_resp= $reg['id']; //echo $id_resp; 
	$respuesta=$reg['respuesta']; // echo $respuesta;
	
    ${'reply'.$i}[1] = "$respuesta";
	${'id'.$i}[1] = "$id_resp"; 
 	$i=$i+1;	
}


//Variables para guardar los datos 
	$question=$preg; $point=$punt; $category=$id_categ; $from=$Fecha1; $to=$Fecha2; $start=$Tiempo1; $end=$Tiempo2;
	$seleccionado1 = $id_categ;
	
// echo " valor de i: $i";

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

			
		/*$question=$_POST['pregunta'];
		$point=$_POST['puntos'];
		$category=$_POST['categoria'];
		$autor=$_POST['autor'];
		$from=$_POST['from'];
		$from=explode('/',$from);
		$from=$from[2].'-'.$from[1].'-'.$from[0];
		$to=$_POST['to'];
		$to=explode('/',$to);
		$to=$to[2].'-'.$to[1].'-'.$to[0];
		$start=$_POST['horaStart'];
		$start=explode(':',$start);
		$start=$start[0].':'.$start[1].':00';
		$end=$_POST['horaEnd'];
		$end=explode(':',$end);
		$end=$end[0].':'.$end[1].':00';*/
		$question=$_POST['pregunta'];
		$point=$_POST['puntos'];
		$category=$_POST['categoria'];
		$autor=$_POST['autor'];
		if(isset($_POST['from']) && $_POST['from']!=""){
			$from=$_POST['from'];
			$from_insert=explode('/',$from);
			$from_insert=$from_insert[2].'-'.$from_insert[1].'-'.$from_insert[0];
		}
		if(isset($_POST['to']) && $_POST['to']!=""){
			$to=$_POST['to'];
			$to_insert=explode('/',$to);
			$to_insert=$to_insert[2].'-'.$to_insert[1].'-'.$to_insert[0];
		}
		if(isset($_POST['horaStart']) && $_POST['horaStart']!=""){
			$start=$_POST['horaStart'];
			$start_insert=explode(':',$start);
			$start_insert=$start_insert[0].':'.$start_insert[1].':00';
		}
		if(isset($_POST['horaEnd']) && $_POST['horaEnd']!=""){
			$end=$_POST['horaEnd'];
			$end_insert=explode(':',$end);
			$end_insert=$end_insert[0].':'.$end_insert[1].':00';
		}
		$reply1[1]=$_POST['respuesta1'];
		$reply2[1]=$_POST['respuesta2'];
		$reply3[1]=$_POST['respuesta3'];
		$reply4[1]=$_POST['respuesta4'];
		$reply5[1]=$_POST['respuesta5'];
		$reply6[1]=$_POST['respuesta6'];
		$reply7[1]=$_POST['respuesta7'];
		$reply8[1]=$_POST['respuesta8'];
		
		fechaDeHoy();
		validaCantidadRespuestas();
		
		$fechaComienzo="$from_insert"." "."$start_insert";
		$fechaFin="$to_insert"." "."$end_insert";
		
		
	if($pregunta != "error" && $puntos != "error" && $categoria != "error" && $desde != "error" && $hasta != "error" && $resp1 != "error" 
	&& $resp2 != "error" && $resp3 != "error" && $resp4 != "error" && $resp5 != "error" && $resp6 != "error" && $resp7 != "error" && $resp8 != "error")	
					
					$mostrarRespuestas = 1;
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link type="text/css" href="css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<link rel="stylesheet" href="css/jquery.ui.timepicker.css" type="text/css" />
<link type="text/css" href="css/estilo.css" rel="stylesheet" />

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
					minuteText: 'Minutos'
					}); 	

				$('#horaEnd').timepicker({
					hourText: 'Horas',
					minuteText: 'Minutos'
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

if(isset($_POST['categoria']) && $_POST['categoria']!=""){
		$seleccionado1 = $_POST['categoria'];
}
?>

<?php include_once './cabecera.php'; ?>

<?php if(!isset($mostrarRespuestas)):?>

<div class="demo" align="center">

<div style="display:inline; float:right"> <a href="listarPreguntasCreadas.php">Volver</a> </div>
 
<!-- <h2 align="center">Carga de Preguntas</h2> -->

<FORM ACTION="accionesRespuestaCreada.php?idPreg=<?php  echo $idPregunta; ?>" METHOD="post">
  <table cellspacing="3" cellpadding="3" align="center" >
    
    <tr>
      <td align="right">Pregunta:</td>
      <td colspan="5"><textarea name="pregunta" rows="2" cols="70" maxlength="140"><?php echo(trim($question)); ?></textarea> </td>
    </tr>
    <tr>
       
      <td align="right">Puntos:</td>
      <td ><INPUT TYPE="text" NAME="puntos" ID="puntos" SIZE=10 MAXLENGTH=4 value="<?php echo(trim($point)); ?>"></td>
      
      <td align="right">Categoria:</td>
      <td><select name = "categoria" >      
         
		 <?php 
			$datosCategoria = array("Categorias:", "Deportes", "Politica y Economia", "Espectaculo", "Miscelanea");   
			$id_categoria = array(0,2,3,5,4);  
	 		for($i=0; $i<count($datosCategoria); $i++) {
            	if($id_categoria[$i]==$seleccionado1) {
               		echo "<option value='".$id_categoria[$i]."' selected>".$datosCategoria[$i]."</option>";
            	}
            	else {
               		echo "<option value='".$id_categoria[$i]."'>".$datosCategoria[$i]."</option>";
            	}
         	}
?>      
     </select></td>
        
      <td align="right">Autor:</td>
      <td width="100"><INPUT TYPE="text" NAME="autor" SIZE=20 MAXLENGTH=20 VALUE="<?php echo $auto; ?>"></td>
    
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
<!--      <div class='timepicker_button_trigger'
             style="width: 18px; height:18px; background: url(Imagenes/reloj.png); display: inline-block; 
             border-radius: 2px; border: 1px solid #222222;"></div> -->
      </td>
      <td align="center">Hora de Fin:</td>
      <td colspan="2"><input type="text" id="horaEnd" name="horaEnd" size="15" value="<?php echo(trim($end)); ?>">
<!--      <div class='timepicker_button_trigger'
             style="width: 18px; height:18px; background: url(Imagenes/reloj.png); display: inline-block;
             border-radius: 2px; border: 1px solid #222222;"></div> -->
      </td>
    </tr>
    
    </table>
    
    
    <h2 align="center">Carga de Respuestas</h2>
    
    <table cellpadding="3" cellspacing="3" align="center">
    
    <tr> 
    <td>Respuesta 1:</td> 
    <td><INPUT TYPE="text" NAME="respuesta1" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply1[1])) ?>"> </td>
    <td> <a href="eliminarRespuesta.php?idResp=<?php  echo $id1[1]; ?> "> Eliminar </a> </td>
    <tr>
    
     <tr> 
    <td>Respuesta 2:</td> 
    <td><INPUT TYPE="text" NAME="respuesta2" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply2[1])); ?>"></td>
    <td> <a href="eliminarRespuesta.php?idResp=<?php  echo $id2[1]; ?> "> Eliminar </a> </td> 
    <tr>
    
    <tr>  
    <td>Respuesta 3:</td> 
    <td><INPUT TYPE="text" NAME="respuesta3" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply3[1])); ?>"></td> 
    <td> <a href="eliminarRespuesta.php?idResp=<?php  echo $id3[1]; ?> "> Eliminar </a> </td>
    <tr>
    
    <tr> 
    <td>Respuesta 4:</td> 
    <td><INPUT TYPE="text" NAME="respuesta4" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply4[1])); ?>"></td> 
    <td> <a href="eliminarRespuesta.php?idResp=<?php  echo $id4[1]; ?> "> Eliminar </a> </td>
    <tr>
    
     <tr> 
    <td>Respuesta 5:</td> 
    <td><INPUT TYPE="text" NAME="respuesta5" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply5[1])); ?>"></td>
    <td> <a href="eliminarRespuesta.php?idResp=<?php  echo $id5[1]; ?> "> Eliminar </a> </td> 
    <tr>
    
     <tr> 
    <td>Respuesta 6:</td> 
    <td><INPUT TYPE="text" NAME="respuesta6" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply6[1])); ?>"></td>
    <td> <a href="eliminarRespuesta.php?idResp=<?php  echo $id6[1]; ?> "> Eliminar </a> </td> 
    <tr>
    
     <tr> 
    <td>Respuesta 7:</td> 
    <td><INPUT TYPE="text" NAME="respuesta7" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply7[1])); ?>"></td>
    <td> <a href="eliminarRespuesta.php?idResp=<?php  echo $id7[1]; ?> "> Eliminar </a> </td> 
    <tr>
    
    <tr> 
    <td>Respuesta 8:</td> 
    <td><INPUT TYPE="text" NAME="respuesta8" SIZE=100 MAXLENGTH=95 VALUE="<?php echo(trim($reply8[1])); ?>"></td>
    <td> <a href="eliminarRespuesta.php?idResp=<?php  echo $id8[1]; ?> "> Eliminar </a> </td>    
    </tr>
    
    <tr>
    <td colspan="2" align="center"> <input name="cargarPregunta" type="submit" class="boton" value="Agregar o Modificar Pregunta" /> </td>
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
	
	<?php } ?>
	

<?php } // cierra el if de la linea 262 ?>

<?php else: 
	
	$calificacion=0;
	$votos=0;
	$pregunta = mysql_real_escape_string($question);  // Elimina caracteres especiales de una cadena
    $pregunta = trim($pregunta); 
	
	// actualiza la pregunta
    $actuPregunta=mysql_query("UPDATE preguntas SET pregunta='".$pregunta."', puntos='".$point."', id_categoria='".$category."', autor='".$autor."', 
	fecha_inicio='".$fechaComienzo."',	fecha_fin='".$fechaFin."' WHERE id=$idPregunta") or die("Problemas en el update:".mysql_error());
	
//	echo "<br> Valor del contador: $contador - Muestra cuantas respuestas hay";
//	echo "<br> Valor de i: $i - Muestra cuantas respuestas fueron cargadas desde la BD ";
//	echo "<br> Valores de los ID: $id1[1] $id2[1] $id3[1] $id4[1] $id5[1] $id6[1] $id7[1] $id8[1]";
		
	for ($j = 1; $j < $i; $j++){
		
		 $actuRespuesta=mysql_query("UPDATE respuestas SET respuesta='".${'reply'.$j}[1]."' WHERE id='".${'id'.$j}[1]."' ") 
		 or die("Problemas en el update:".mysql_error());
		
	//	echo "<br> ID:";
	//	print_r(${'id'.$j}[1]);
		
	//	echo "<br> RESPUESTA:";
	//	print_r(${'reply'.$j}[1]);
		
	}	
	
//	echo " <br> valor de j $j";
	
	for ($k = $j ; $k < $contador ; $k++){
		
		
		$regResp = mysql_query("INSERT INTO respuestas (id_pregunta,respuesta) VALUES 
		('".$idPregunta."', '".${'reply'.$k}[1]."')");	
		
	//	echo "<br> Muestra las otras respuestas --  ";
	//	print_r(${'reply'.$k}[1]);
			
		}
?>

<br>
<center>
  <h1>¡La pregunta ha sido Modificada con éxito!</h1>
</center>
<center>
  <img src="Imagenes/tilde.jpg">
</center>

  <DIV class="demo"  align="center">
    
    <table border="0" width="500">  
      
      <tr align="center">
           <td><h4>Para ver mas preguntas creadas presiona en el boton Ver Preguntas Creadas. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="listarPreguntasCreadas.php">Ver Preguntas Creadas</a> </td>
      </tr>
      
       
      <tr align="center">
           <td><h4>Para volver a la pregunta anterior presiona en el boton Volver </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="<?php $_SERVER["HTTP_REFERER"] ?>">Volver</a> </td>
      </tr>
      
    </table>
	
 </DIV>
   
<?php 
endif;
?>

</div>
	<br><br>
 	<!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
    <!-- Fin del DIV pie -->

</html>