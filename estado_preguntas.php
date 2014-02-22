<?php 
$estadoCreada = 1 ;
$estadoPublicada = 2;
$estadoFinalizada = 3;
$fecha_hoy = date("d/m/Y H:i");

function date_time($fecha){
	$fecha = explode(' ',$fecha);
	$fecha[0] = explode('-',$fecha[0]);
	$fecha[1] = explode(':',$fecha[1]);
	$fecha = $fecha[0][2].'/'.$fecha[0][1].'/'.$fecha[0][0].' '.$fecha[1][0].':'.$fecha[1][1];	
	return $fecha;
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
	
	// devuelve la marca de tiempo UNIX de las fechas y su diferencia
	$Fec1 = mktime($Hora1,$Minuto1,0,$Mes1,$Dia1,$Anio1);
	$Fec2 = mktime($Hora2,$Minuto2,0,$Mes2,$Dia2,$Anio2);
	$Dif = $Fec1 - $Fec2;
	return ($Dif); 
}
// Selecciona todas las preguntas que tenga estado creada
$rs = mysql_("SELECT * FROM preguntas WHERE estado='".$estadoCreada."'");
$tot_registros = mysql_num_rows($rs);

// recorre todas las preguntas con el estado creada
if($tot_registros){
	while($row = mysql_fetch_array($rs)){
		// Captura la fecha de comienzo
		$fecha_inicio = date_time($row['fecha_inicio']);
		// Captura el id de la pregunta 
		$id_preg = $row['id'];
		
		if (compara_fechas($fecha_hoy,$fecha_inicio) >= 0) {
			mysql_("UPDATE preguntas SET estado='".$estadoPublicada."' WHERE id='$id_preg'");
		}
	}
}

// Selecciona todas las preguntas que tenga estado publicada
$rs = mysql_("SELECT * FROM preguntas WHERE estado='".$estadoPublicada."'");
$tot_registros = mysql_num_rows($rs);

// recorre todas las preguntas con el estado publicadas
if($tot_registros){
	while($row = mysql_fetch_array($rs)) {
		// Captura la fecha de comienzo
		$fecha_fin = date_time($row['fecha_fin']);
		// Captura el id de la pregunta 
		$id_preg = $row['id'];
		
		if (compara_fechas($fecha_hoy,$fecha_fin) >= 0) {
			mysql_("UPDATE preguntas SET estado='".$estadoFinalizada."' WHERE id='$id_preg'");
		}
	}
}
?>