<?php 

$estadoCreada = 1 ;
$estadoPublicada = 2 ;
$estadoFinalizada = 3;

$fechaHoy = date("d/m/Y H:i");
// Selecciona todas las preguntas que tenga estado creada
$registros=mysql_query("SELECT * FROM preguntas WHERE estado='".$estadoCreada."'") or die("Problemas en el select:".mysql_error());
$tot_registros = mysql_num_rows($registros);
// recorre todas las preguntas con el estado creada
if($tot_registros){
	while($reg = mysql_fetch_array($registros)) {
		
				
			// Captura la fecha de comienzo
			$fechaStart = date_time($reg['fecha_inicio']);
			// Captura el id de la pregunta 
			$id_preg = $reg['id'];
			
			/*if (compara_fechas($fechaHoy,$fechaStart) < 0){
				echo "$fechaHoy es menor que $fechaStart <br>";
			}*/
			
			if (compara_fechas($fechaHoy,$fechaStart) >= 0) {
			 mysql_query("UPDATE preguntas SET estado='".$estadoPublicada."' WHERE id='$id_preg'") or die("Problemas en update:".mysql_error());
			}
			
			/*if (compara_fechas($fechaHoy,$fechaStart) == 0){
			 echo "$fechaHoy es igual que $fechaStart - Se cambio el estado <br>";
			 mysql_query("UPDATE preguntas SET estado='".$estadoPublicada."' WHERE idPregunta='$id_preg'") or die("Problemas en update:".mysql_error());
			}*/	
	}
}


// Selecciona todas las preguntas que tenga estado publicada
$registros=mysql_query("SELECT * FROM preguntas WHERE estado='".$estadoPublicada."'") or die("Problemas en el select:".mysql_error());

// recorre todas las preguntas con el estado publicadas
while($reg = mysql_fetch_array($registros)) {
	
			
		// Captura la fecha de comienzo
		$fechaEnd = date_time($reg['fecha_fin']);
		// Captura el id de la pregunta 
		$id_preg = $reg['id'];
		
		/*if (compara_fechas($fechaHoy,$fechaEnd) < 0){
			echo "$fechaHoy es menor que $fechaEnd <br>";
		}*/
		
		if (compara_fechas($fechaHoy,$fechaEnd) >= 0) {
		 mysql_query("UPDATE preguntas SET estado='".$estadoFinalizada."' WHERE id='$id_preg'") or die("Problemas en update:".mysql_error());
		}
		
		/*if (compara_fechas($fechaHoy,$fechaEnd) == 0){
		 echo "$fechaHoy es igual que $fechaEnd - Se cambia< el estado <br>";
		 mysql_query("UPDATE preguntas SET estado='".$estadoFinalizada."' WHERE idPregunta='$id_preg'") or die("Problemas en update:".mysql_error());
		}*/	
}

function compara_fechas($FechaHora1, $FechaHora2) {
	
	// Sapara la Fecha y Hora	
	list($Fecha1,$Tiempo1) = explode(" ",$FechaHora1);
	list($Fecha2,$Tiempo2) = explode(" ",$FechaHora2);
	
	// Separa la Hora y los Minutos
	list($Hora1,$Minuto1) = explode(":",$Tiempo1);
	list($Hora2,$Minuto2) = explode(":",$Tiempo2);
	
	//Separa los Dias, Mes y Años			   
	list($Dia1,$Mes1,$Anio1) = explode("/",$Fecha1);
	list($Dia2,$Mes2,$Anio2) = explode("/",$Fecha2);
	
	// lleva a enteros la hora, minutos, dia, mes y año
	$Hora1=(int)$Hora1;  
	$Hora1 = $Hora1 - 1;
	$Hora2=(int)$Hora2;		
	$Minuto1=(int)$Minuto1; 
	$Minuto2=(int)$Minuto2;
	$Dia1=(int)$Dia1;  $Dia2=(int)$Dia2;
	$Mes1=(int)$Mes1;  $Mes2=(int)$Mes2;
	$Anio1=(int)$Anio1;  $Anio2=(int)$Anio2;
	
	// muestra los valores de las fechas
//	echo "$Hora1,$Minuto1,$Mes1,$Dia1,$Anio1 ---";
//	echo "$Hora2,$Minuto2,$Mes2,$Dia2,$Anio2 ---";
	
	// lleva la fecha a un solo numero enteero
	$Fec1 = mktime($Hora1,$Minuto1,0,$Mes1,$Dia1,$Anio1);
	$Fec2 = mktime($Hora2,$Minuto2,0,$Mes2,$Dia2,$Anio2);
	
	// Realiza la diferecia entre la fecha de hoy y la fecha del comienzo de la pregunta
	$Dif = $Fec1 - $Fec2;
	
	// Devuelve la diferencia 
	return ($Dif); 
}

?>