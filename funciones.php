<?php
function mysql_($query){
	$rs = mysql_query($query, $GLOBALS['cnx']) or die(mysql_error());
	return $rs;
}
function rows_($query){
	$rs = mysql_($query);
	$i = 0;
	$x = array();
	while($row = mysql_fetch_assoc($rs)){
		$x[$i] = $row;
		$i++;
	};
	return $x;	
}

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
  if(PHP_VERSION < 6){
	$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch($theType){
	case "text":
	  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
	  break;    
	case "long":
	case "int":
	  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
	  break;
	case "double":
	  $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
	  break;
	case "date":
	  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
	  break;
	case "defined":
	  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
	  break;
  }
  return $theValue;
}

function curPageName(){
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

function perfil($id){
	$query = "SELECT Us.id, Us.usuario, DU.foto, Pu.puntos, Pr.provincia FROM usuarios Us
                    INNER JOIN datos_usuarios DU ON DU.id_usuario = Us.id 
                    INNER JOIN puntaje Pu ON Pu.id_usuario = Us.id
                    INNER JOIN provincias Pr ON Pr.id = DU.id_provincia
                    WHERE Us.id = $id AND Pu.id_categoria = 1";
				
	$rs = mysql_($query);
	$row_perfil = mysql_fetch_assoc($rs);
	$puntos = $row_perfil['puntos'];
	
	$query = "SELECT Pu.id_usuario, Pu.puntos, Pr.provincia FROM puntaje Pu
                    INNER JOIN datos_usuarios DU ON DU.id_usuario = Pu.id_usuario  
                    INNER JOIN provincias Pr ON Pr.id = DU.id_provincia 
                    WHERE Pu.id_categoria = 1 
                    ORDER BY puntos DESC, id_usuario";
				
	$rs = mysql_($query);		

	do{
		static $pos_general = 0;
		static $pos_provincia = 0;
		$row = mysql_fetch_assoc($rs);
		$pos_general++;
		$x = $row['id_usuario'];
		if($row['provincia'] == $row_perfil['provincia']){
			$pos_provincia++;
		}
	}while($x != $id);
	
	$row_perfil['pos_general'] = $pos_general;
	$row_perfil['pos_provincia'] = $pos_provincia;
	
	return $row_perfil;
}

function preguntas($id, $categoria = 1){
	$hoy = date("Y-m-d H:i:s");
	
	$query = "SELECT Pr.id FROM preguntas Pr
				RIGHT JOIN respuestas_usuarios RU ON RU.id_pregunta = Pr.id
				WHERE RU.id_usuario = $id AND Pr.estado = 2";
	if($categoria != 1 ){
		$query .= " AND Pr.id_categoria = $categoria";
	}
	
	$rs = mysql_($query);
	$preguntas_listas=0;
	while($row = mysql_fetch_assoc($rs)){
		$preguntas_listas .= ','.$row['id'];
	}
	
	$query = "SELECT Pr.* FROM preguntas Pr
				WHERE Pr.estado = 2 AND Pr.id NOT IN($preguntas_listas)";
	if($categoria != 1 ){
		$query .= " AND Pr.id_categoria = $categoria";
	}
	$query .= " ORDER BY Pr.fecha_fin";
	
	$rs = mysql_($query);
	while($row_preguntas = mysql_fetch_assoc($rs)){
		static $i=0;
		$id_pregunta = $row_preguntas['id'];
		$query2 = "SELECT Re.respuesta, Re.id AS id_respuesta FROM respuestas Re
					WHERE Re.id_pregunta = $id_pregunta";
		$rs2 = mysql_($query2);
		$j=0;
		while($row_respuestas = mysql_fetch_assoc($rs2)){
			$respuestas[$i][$j] = $row_respuestas; 	
			$j++;
		}
		$preguntas[$i] = $row_preguntas;
		$i++;
	}
	if(isset($preguntas)){
		$resp[0] = $preguntas;
		$resp[1] = $respuestas;
		return $resp;
	}
}
function color($color){	
	switch($color){
		case 1:
			return '#4a4a4a';
		break; 
		
		case 2:
			return '#67c184';
		break;
		
		case 3:
			return '#66a3c1';
		break;
		
		case 4:
			return '#c1c166';
		break;
		
		case 5:
			return '#ad4733';
		break;	
	}
}
function get_provincias(){
	$rs = mysql_("SELECT * FROM provincias");
	while($row = mysql_fetch_assoc($rs)){
		static $i = 0;
		$i++;
		$provincias[$i] = $row;
	};
	return $provincias;
}
function get_categoria(){
	$rs = mysql_("SELECT * FROM categorias WHERE id != 1");
	while($row = mysql_fetch_assoc($rs)){
		static $i = 0;
		$i++;
		$categoria[$i] = $row;
	};
	return $categoria;
}
function get_torneos($inicio, $registros, $busqueda = 0){
    $query = "SELECT Tr.id, Tr.nombre_torneo, Tr.id_usuario, 
                Us.usuario AS admin, COUNT(TU.id) AS cantidad, 
                FLOOR((SUM(Pu.puntos)/COUNT(TU.id))) AS promedio 
                FROM torneos Tr
                INNER JOIN usuarios Us ON Us.id = Tr.id_usuario
                INNER JOIN torneos_usuarios TU ON Tr.id = TU.id_torneo
                INNER JOIN puntaje Pu ON Pu.id_usuario = TU.id_usuario
                WHERE Pu.id_categoria = 1 
                    AND TU.estado != 0";

    if($busqueda){
            $busqueda = GetSQLValueString($busqueda, "text");
            $busqueda = str_replace("'","",$busqueda);
            $query .= " AND Tr.nombre_torneo LIKE '%$busqueda%'";
    }
    $query .= " GROUP BY nombre_torneo ORDER BY promedio DESC";
    if($registros){
            $query .= " LIMIT $inicio, $registros";
    }
    $result = rows_($query);
    return 	$result;	
}
function get_torneo_info($id_torneo){
    $query = "SELECT Tr.nombre_torneo, Tr.id_usuario AS id_admin, TU.estado, 
                TU.id_usuario, Us.usuario, Pr.provincia, 
                DU.fecha_inscripcion AS fecha, Pu.puntos 
                FROM torneos Tr
                INNER JOIN torneos_usuarios TU ON TU.id_torneo = Tr.id
                INNER JOIN usuarios Us ON Us.id = TU.id_usuario
                INNER JOIN datos_usuarios DU ON DU.id_usuario = Us.id
                INNER JOIN puntaje Pu ON Pu.id_usuario = Us.id
                INNER JOIN provincias Pr ON Pr.id = DU.id_provincia
                WHERE TU.id_torneo = $id_torneo 
                    AND Us.estado = 1 
                    AND Pu.id_categoria = 1
                ORDER BY puntos DESC";
    $result = rows_($query);
    return 	$result;
}
function torneos_usuario($id_usuario, $pendiente){
    $query = "SELECT Tr.id, Tr.nombre_torneo, Tr.id_usuario, TU.estado 
                FROM torneos Tr
                INNER JOIN torneos_usuarios TU ON TU.id_torneo = Tr.id
                WHERE TU.id_usuario = $id_usuario
                AND TU.estado = $pendiente    
                ORDER BY Tr.nombre_torneo";
    $result = rows_($query);
    return 	$result;
}
function usuario_datos($user_id){
    $query = "SELECT Us.usuario, Us.pass, Us.email, DU.nombre, DU.apellido, 
                DU.sexo, DU.nacimiento, DU.dni, DU.telefono, DU.celular, 
                DU.twitter, DU.foto, Pr.provincia, 
                Lo.nombre_ciudad AS localidad 
                FROM usuarios Us
                INNER JOIN datos_usuarios DU ON DU.id_usuario = Us.id
                INNER JOIN provincias Pr ON Pr.id = DU.id_provincia
                INNER JOIN localidades Lo ON Lo.id = DU.id_localidad
                WHERE Us.id = $user_id";
    $result = rows_($query);
    return 	$result[0];
}
function ranking($categoria, $id_provincia = 0) {
    $query = "SELECT Us.id, Us.usuario, Pr.provincia, Pu.puntos 
                FROM usuarios Us
                INNER JOIN puntaje Pu ON Pu.id_usuario = Us.id
                INNER JOIN datos_usuarios DU ON DU.id_usuario = Us.id
                INNER JOIN provincias Pr ON Pr.id = DU.id_provincia
                WHERE Us.estado = 1 
                AND Pu.id_categoria = $categoria";

    if ($id_provincia != 0) {
        $query .= " AND Pr.id = $id_provincia";	
    }

    $query .= " ORDER BY Pu.puntos DESC, id LIMIT 50";

    $result = rows_($query);
    $porcentaje_usuarios = get_correctas($result, $categoria);

    $cant = count($result);
    $i=0;
    while ($i < $cant) {
        $result[$i]['porcentaje'] = $porcentaje_usuarios[$i];
        $i++;
    }
    return $result;
}

function rankingMensual($categoria, 
                        $id_provincia = 0, 
                        $id_mes = "00", 
                        $id_anio = "00",
                        $id_usuario = 0) {
    
    $query = 'SELECT u.id, sum(puntos) as puntos, u.usuario, prov.provincia 
                FROM preguntas p 
                INNER JOIN respuestas r 
                INNER JOIN respuestas_usuarios ru 
                INNER JOIN usuarios u 
                INNER JOIN datos_usuarios du 
                INNER JOIN provincias prov 
                WHERE p.id = r.id_pregunta 
                    AND ru.id_pregunta = p.id 
                    AND ru.id_respuesta = r.id 
                    AND ru.id_usuario = u.id 
                    AND u.id = du.id_usuario 
                    AND du.id_provincia = prov.id
                    AND r.correcta = 1 ';
    
    if ($id_usuario != 0) {
        $query .= "AND u.id = $id_usuario ";
    }

    if (isset($categoria) && $categoria != "1") {
        $query .= "AND p.id_categoria = $categoria ";
    }

    if ($id_provincia != 0){
        $query .= "AND prov.id = $id_provincia ";	
    }

    if ($id_mes != "00"){
        $query .= 'AND p.mes = "' . $id_mes . '" ';	
    }

    if ($id_anio != "00"){
        $query .= 'AND p.anio = "' . $id_anio . '" ';	
    }

    $query .= 'GROUP BY u.id ';
    $query .= "ORDER BY 2 DESC, u.id LIMIT 50";

    $result = rows_($query);

    $porcentaje_usuarios = get_correctas(
            $result, $categoria, $id_mes, $id_anio
    );

    $cant = count($result);
    $i=0;
    while($i < $cant){
        $result[$i]['porcentaje'] = $porcentaje_usuarios[$i];
        $i++;
    }
    return 	$result;
}

function get_correctas($result, $categoria, $id_mes = "00", $id_anio = "00"){
    $cant = count($result);
    $porcentaje_usuarios = array();
    $i=0;
    while($i < $cant){
        $users_id = $result[$i]['id'];
        $query = "SELECT COUNT(RU.id) AS cant 
                    FROM respuestas_usuarios RU
                    INNER JOIN respuestas Re ON RU.id_respuesta = Re.id
                    INNER JOIN preguntas Pr ON RU.id_pregunta = Pr.id
                    WHERE Re.correcta = 1 
                    AND RU.id_usuario = $users_id ";
        
        if (isset($categoria) && $categoria != 1) {
            $query .= "AND Pr.id_categoria = $categoria ";
        }
        
        if (isset($id_mes) && $id_mes != "00") {
            $query .= "AND Pr.mes = $id_mes ";
        }
        
        if (isset($id_anio) && $id_anio != "00") {
            $query .= "AND Pr.anio = $id_anio ";
        }
        
        $query .= "ORDER BY RU.id_usuario";        

        $rs = mysql_($query);
        $row = mysql_fetch_assoc($rs);
        $cant_correctas	= $row['cant'];

        $query = "SELECT COUNT(RU.id) AS cant 
                    FROM respuestas_usuarios RU
                    INNER JOIN preguntas p ON p.id = RU.id_pregunta 
                    WHERE p.estado = 4 ";
        
        if (isset($categoria) && $categoria != 1) {
            $query .= "AND p.id_categoria = $categoria ";
        }
        
        if (isset($id_mes) && $id_mes != "00") {
            $query .= "AND p.mes = $id_mes ";
        }
        
        if (isset($id_anio) && $id_anio != "00") {
            $query .= "AND p.anio = $id_anio ";
        }
        
        $query .= "AND RU.id_usuario = $users_id
                   ORDER BY RU.id_usuario";        

        $rs = mysql_($query);
        $row = mysql_fetch_assoc($rs);
        $cant_respondidas = $row['cant'];

        if ($cant_respondidas != 0){
                $porcentaje_usuarios[$i] = 
                    $cant_correctas . ' / ' . $cant_respondidas;
        }
        else{
                $porcentaje_usuarios[$i] = "0 / 0";
        }
        $i++;
    }

    return $porcentaje_usuarios;
}

function get_novedades(){
	return rows_("SELECT * FROM novedades ORDER BY fecha DESC");	
}

function get_premios(){
	return rows_("SELECT * FROM premios ORDER BY id DESC");
}

function get_preguntas_usuario($usuario) {
    
    $query = "SELECT * 
                FROM respuestas_usuarios ru
                INNER JOIN preguntas pr ON ru.id_pregunta = pr.id
                INNER JOIN respuestas re ON ru.id_respuesta = re.id
                INNER JOIN categorias ca ON pr.id_categoria = ca.id
                WHERE id_usuario = $usuario
                ORDER BY pr.fecha_fin DESC";

    $preguntas = rows_($query);
    
    return $preguntas;
}

function get_respuesta_correcta($id_pregunta) {
    
    $query = "SELECT * 
                FROM respuestas r
                WHERE id_pregunta = $id_pregunta 
                AND correcta = 1;";

    $rs = mysql_($query);
    $correcta = mysql_fetch_assoc($rs);
    
    return $correcta;
}