<?php
require_once('cnx.php');
require_once('funciones.php');

$operacion = $_POST['operacion'];
if(isset($_SESSION['usuario'])){
	$user_id = $_SESSION['id'];
}
else{
	$user_id = 0;	
}
if(isset($_POST['categoria'])){$categoria = $_POST['categoria'];}
if(isset($_POST['id_pregunta'])){$id_pregunta = $_POST['id_pregunta'];}
if(isset($_POST['id_respuesta'])){$id_respuesta = $_POST['id_respuesta'];}
if(isset($_POST['id_provincia'])){$id_provincia = $_POST['id_provincia'];}
if(isset($_POST['id_mes'])){$id_mes = $_POST['id_mes'];}
if(isset($_POST['id_anio'])){$id_anio = $_POST['id_anio'];}
if(isset($_POST['id_torneo'])){$id_torneo = $_POST['id_torneo'];}
if(isset($_POST['id_usuario'])){$id_usuario = $_POST['id_usuario'];}
if(isset($_POST['foto_usuario'])){$foto_usuario = $_POST['foto_usuario'];}
if(isset($_POST['nombre_torneo'])){$nombre_torneo = $_POST['nombre_torneo'];}
if(isset($_POST['estado_torneo'])){$estado_torneo = $_POST['estado_torneo'];}
if(isset($_POST['nick'])){$nick = $_POST['nick'];}
if(isset($_POST['email'])){$email = $_POST['email'];}
if(isset($_POST['pass'])){$pass = $_POST['pass'];}
if(isset($_POST['nombre'])){$nombre = $_POST['nombre'];}
if(isset($_POST['apellido'])){$apellido = $_POST['apellido'];}
if(isset($_POST['dni'])){$dni = $_POST['dni'];}
if(isset($_POST['sexo'])){$sexo = $_POST['sexo'];}
if(isset($_POST['provincia'])){$provincia = $_POST['provincia'];}
if(isset($_POST['localidad'])){$localidad = $_POST['localidad'];}
if(isset($_POST['twitter'])){$twitter = $_POST['twitter'];}
if(isset($_POST['telefono'])){$telefono = $_POST['telefono'];}
if(isset($_POST['celular'])){$celular = $_POST['celular'];}
if(isset($_POST['inicio'])){$inicio = $_POST['inicio'];}
if(isset($_POST['registros'])){$registros = $_POST['registros'];}


if(isset($_POST['nacimiento'])){
	$nacimiento = $_POST['nacimiento'];
	$nacimiento = explode('/',$nacimiento);
	$nacimiento = $nacimiento[2].'-'.$nacimiento[1].'-'.$nacimiento[0];
}
if(isset($_POST['busqueda'])){
	$busqueda = $_POST['busqueda'];
}
else{ 
	$busqueda = 0;
};
$hoy = date('Y-m-d');

switch($operacion){    
	case 1: //MUESTRA LAS PREGUNTAS
		$resp = preguntas($user_id, $categoria);
		$preguntas = $resp[0];
		$respuestas = $resp[1];
		for($i=0; $i < count($preguntas); $i++){ 
			$color = color($preguntas[$i]['id_categoria']);
			echo '<article class="pregunta" '; 
			if($i == (count($preguntas) - 1)){
				echo 'style="margin-bottom:0;"';
			} 
			echo '>';
			echo '<div class="info_pregunta">
					<div class="titulo" style="border-bottom:2px solid '.$color.';">
						&iquest;'.$preguntas[$i]["pregunta"].'?
					</div>
					<div class="respuestas">';
			for($j=0; $j < count($respuestas[$i]); $j++){
				echo '<div class="opcion">
						<input type="radio" name="respuesta'.$i.'" value="'.$respuestas[$i][$j]["id_respuesta"].'" />&nbsp;'.$respuestas[$i][$j]["respuesta"].'
						</div>';
			}
			echo '</div>
					</div>';
					
			$fecha = explode(' ',$preguntas[$i]['fecha_fin']);
			$hora = $fecha[1];
			$fecha = $fecha[0];
			$fecha = explode('-',$fecha);
			$hora = explode(':',$hora);
					
			echo '<div class="placa" style="background-color:'.$color.';">
					<div class="vencimiento">Vencimiento<br /><span>'.$fecha[2].'/'.$fecha[1].'/'.$fecha[0].' '.$hora[0].':'.$hora[1].'</span></div>
					<div class="puntos">Puntos<br /><span>'.$preguntas[$i]["puntos"].'</span></div>
					<div class="autor">Autor<br /><span>'.$preguntas[$i]["autor"].'</span></div>
					<div class="responder color_'.$preguntas[$i]['id_categoria'].'" onclick="validar_respuesta('.$preguntas[$i]['id'].','.$i.','.$user_id.')">Responder</div>
					</div>
					</article>';
        }
		echo '<input type="hidden" id="categoria" name="categoria" value="'.$categoria.'">';
	break;
	
	case 2: //SUBE LA FOTO DE LOS USUARIOS
		ini_set("memory_limit","48M");
		if($_FILES['foto']['size'] > 0){
			$nombre = date("U");
			$directorio_ruta = 'fotos/'.$nombre.'.jpg';
			if(!(move_uploaded_file($_FILES['foto']['tmp_name'],$directorio_ruta))){
				echo 'error';
			}else{
				$ancho_maximo = 100; // coloco aca el ancho maximo
				$alto_maximo = 120;  // coloco aca el alto maximo
				$imagen = $directorio_ruta;
				$im = NULL;
				if(stristr($imagen, 'jpg')){
					$im = imagecreatefromjpeg($imagen);
				}
				if($im !== NULL){
					
					if ((imagesx($im) >= $ancho_maximo) or (imagesy($im) >= $alto_maximo)){
						if(imagesx($im) > imagesy($im)){
							$alto = imagesy($im) * $ancho_maximo / imagesx($im);
							$dest = imagecreatetruecolor($ancho_maximo, $alto);
							imagecopyresampled($dest, $im, 0, 0, 0, 0, $ancho_maximo, $alto, imagesx($im), imagesy($im));
							imagejpeg($dest, $directorio_ruta, 100);
							chmod($directorio_ruta,0777);
							imagedestroy($dest);
							//echo 'se modifico al ancho maximo.<br />';
								
						}elseif(imagesy($im) > imagesx($im)){
							$ancho = imagesx($im) * $alto_maximo / imagesy($im);
							$dest = imagecreatetruecolor($ancho, $alto_maximo);
							imagecopyresampled($dest, $im, 0, 0, 0, 0, $ancho, $alto_maximo, imagesx($im), imagesy($im));
							imagejpeg($dest, $directorio_ruta, 100);
							chmod($directorio_ruta,0777);
							imagedestroy($dest);
							//echo 'se modifico al alto maximo.<br />';
						}else{
							$ancho = imagesx($im) * $alto_maximo / imagesy($im);
							$alto = $alto_maximo;
							$dest = imagecreatetruecolor($ancho, $alto);
							imagecopyresampled($dest, $im, 0, 0, 0, 0, $ancho, $alto, imagesx($im), imagesy($im));
							imagejpeg($dest, $directorio_ruta, 100);
							chmod($directorio_ruta,0777);
							imagedestroy($dest);
							//echo 'se modifico al alto y ancho maximo.<br />';
						}
						echo $nombre.'.jpg';
					}else{
						//echo 'error, no supera el minimo esperado';	
					}
				}
			}
		}
	break;
	
	case 3: //INSERTA EN LA BASE LA RESPUESTA DE UN USUARIO
		$rs = mysql_("INSERT INTO respuestas_usuarios (id_usuario,id_pregunta,id_respuesta)
					VALUES ($user_id, $id_pregunta, $id_respuesta)");
		$rs = mysql_("UPDATE respuestas SET total_votos = total_votos + 1 WHERE id = $id_respuesta");
	break;
	
	case 4: //SELECCIONA LAS LOCALIDADES DE UNA PROVINCIA
		$rs = mysql_("SELECT id, nombre_ciudad FROM localidades 
						WHERE id_provincia = $id_provincia
						GROUP BY nombre_ciudad");
		while($localidades = mysql_fetch_assoc($rs)){
			static $i = 0;
			$i++;
                        $nombreCiudad = ucwords(strtolower($localidades['nombre_ciudad']));
                        $nombreCiudadEnie = str_replace("Ñ", "ñ", $nombreCiudad);
			echo '<option value="' . $localidades['id'] . '">' . $nombreCiudadEnie . '</option>';
		};
	break;
	
	case 5: //VERIFICA SI EL NICK DE USUSARIO YA EXISTE
		$rs = mysql_("SELECT id FROM usuarios WHERE LOWER(usuario) = LOWER('$nick')");
		$result = mysql_num_rows($rs);
		if($result){
			echo 'repetido';
		}
	break;
	
	case 6: //VERIFICA SI EL EMAIL DE USUSARIO YA EXISTE
		$rs = mysql_("SELECT id FROM usuarios WHERE LOWER(email) = LOWER('$email')");
		$result = mysql_num_rows($rs);
		if($result){
			$result = mysql_fetch_assoc($rs);
			if($result['id'] != $user_id){
				echo 'repetido';
			}
		}
	break;
	
	case 7: //REGISTRAR USUARIO
		$rs = mysql_("SELECT id FROM usuarios WHERE LOWER(usuario) = LOWER('$nick')");
		$result = mysql_num_rows($rs);
		if($result){
			break;
		}
		$rs = mysql_("SELECT id FROM usuarios WHERE LOWER(email) = LOWER('$email')");
		$result = mysql_num_rows($rs);
		if($result){
			break;
		}
		if(($nick == '') || ($pass == '') || ($email == '')  || ($sexo == '') || ($nacimiento == '') || ($provincia == '') || ($localidad == '') || ($foto_usuario == '')){
			break;
		}
		mysql_("INSERT INTO usuarios (usuario, pass, email, estado) VALUES ('$nick', '$pass', '$email', 1)");
		$id = mysql_insert_id();
		mysql_("INSERT INTO datos_usuarios (id_usuario, nombre, apellido, sexo, nacimiento, dni, id_provincia, id_localidad, foto, fecha_inscripcion)
					VALUES ($id, '$nombre', '$apellido', LOWER('$sexo'), '$nacimiento', '$dni', '$provincia', '$localidad', '$foto_usuario', '$hoy')");
		for($i=1;$i<=5;$i++){		
			mysql_("INSERT INTO puntaje (id_usuario, id_categoria, puntos) VALUES ($id, $i, 0)");
		}
		if(isset($_POST['twitter']) && $_POST['twitter'] != ""){
			mysql_("UPDATE datos_usuarios SET twitter = '$twitter' WHERE id_usuario = $id");
		}
		if(isset($_POST['celular']) && $_POST['celular'] != ""){
			mysql_("UPDATE datos_usuarios SET celular = '$celular' WHERE id_usuario = $id");
		}
		if(isset($_POST['telefono']) && $_POST['telefono'] != ""){
			mysql_("UPDATE datos_usuarios SET telefono = '$telefono' WHERE id_usuario = $id");
		}
		
		header('location: preguntas.php?usuario='.$nick.'&pass='.$pass.'');
	break;
	
	case 8: //TABLA TORNEOS
		$total_registros = get_torneos(0,0,$busqueda);
		$total_registros = sizeof($total_registros);
		$torneos = get_torneos($inicio, $registros, $busqueda);
		echo '<form id="buscar_torneo" name="buscar_torneo" action="" method="post">
            	<label for="nombre">Nombre del Torneo </label>
                <input id="torneo_input" name="torneo_input" type="text" />
                <input id="enviar" name="enviar" type="button" onclick="buscar_torneos();" value="Buscar" />
				<input type="hidden" id="estamos_en_busqueda" value="1" />
				<span></span>
            </form>';
		echo '<div id="torneos_grill">';
		echo '<ul class="titulo">
			<li style="margin-right:10px;">#</li>
			<li>Torneo</li>
			<li>Promedio</li>
			<li>Participantes</li>
			<li>Admin</li>
		</ul>';
		
		$i=0;
		foreach($torneos as $key){ 
			echo '<ul class="datos">
				<li class="primero">'.($i+1+$inicio).'</li>
				<li>'.$key['nombre_torneo'].'</li>
				<li>'.$key['promedio'].'</li>
				<li>'.$key['cantidad'].'</li>
				<li>'.$key['admin'].'</li>
				<li class="jugar">';
					if($user_id == 0){
						echo '<span onclick="window.location = \'registrar.php\';">JUGAR</span>';
					}
					else{
						$torneo_id = $key['id'];
						$rs = mysql_("SELECT id FROM torneos_usuarios WHERE id_torneo = $torneo_id AND id_usuario = $user_id");
						$anotado = mysql_num_rows($rs);
						echo '<input type="hidden" id="anotado" value="'.$anotado.'" />';
						if(($key['id_usuario'] == $user_id) || ($anotado == 1)){
							echo '<span style="color:#ccc;">JUGAR</span>';
						}
						else{
							echo '<span id="torneo_'.$torneo_id.'" onclick="torneo_anotar('.$user_id.','.$torneo_id.');">JUGAR</span>';
						}
					}
					echo '<div class="linea"></div>
				</li>
			</ul>';
			$i++;
		};
		
		echo '<div id="paginador">';
                if($inicio > 0) {
                    echo '<a href="#" onclick="mostrar_torneos(0,'.$registros.',1);"><<</a>';
					echo '<a href="#" onclick="mostrar_torneos('.($inicio-$registros).','.$registros.',1);"><</a>';
                }else{
                    echo '<span><<</span>';
					echo '<span><</span>';
                };
        echo '<span>'.(($inicio/$registros)+1).'/'.(floor($total_registros/$registros)+1).'</span>';; 
                if(($inicio + $registros) <= $total_registros) {
                    echo '<a href="#" onclick="mostrar_torneos('.($inicio+$registros).','.$registros.',1);">></a>';
					echo '<a href="#" onclick="mostrar_torneos('.(floor($total_registros/$registros)*$registros).','.$registros.',1);">>></a>';
                }else{
					echo '<span>></span>';
                    echo '<span>>></span>';
                };
		echo '</div></div>';
            
	break;
	
	case 9: //TABLA DE INFORMACION SOBRE UN TORNEO
		$torneo = get_torneo_info($id_torneo);
		echo '<div id="ver_torneo"><div id="nombre">'.$torneo[0]['nombre_torneo'].'</div>
			<div id="promedio">';
				$i = 0;
				$promedio = 0;
				$cant = 0;
				foreach($torneo as $key){
					if($key['estado'] != 0){
						$promedio = $promedio + $key['puntos'];
						$cant = $cant + 1;
					}
					$i++;
				};
				$promedio = ($promedio/$cant);
				echo 'Promedio: '.floor($promedio);
			echo '</div>
			<div id="info_torneo">
				<ul class="titulo">
					<li style="margin-right:10px;">#</li>
					<li>Jugador</li>
					<li>Provincia</li>
					<li>Jugando Desde</li>
					<li>Puntos</li>
				</ul>';
				$i = 0;
				foreach($torneo as $key){
					$fecha = explode('-',$key['fecha']);
					$fecha = $fecha[2].'/'.$fecha[1].'/'.$fecha[0];
					if($key['estado'] == 0){
						echo '<ul class="datos_pendiente">';
					}
					else{
					echo '<ul class="datos">';
					}
					echo '<li class="primero">'.($i + 1).'</li>
						<li>'.$key['usuario'].'</li>
						<li>'.$key['provincia'].'</li>
						<li>'.$fecha.'</li>
						<li>'.$key['puntos'].'</li>';
						echo '<li class="administrar">';
						if($key['id_admin'] == $user_id){
							if($key['estado'] == 0){
								echo '<span onclick="confirmar_usuario_torneo('.$key['id_usuario'].','.$id_torneo.');">CONFIRMAR</span>';
							}
							if($key['id_usuario'] != $user_id){
							echo '<span onclick="eliminar_usuario_torneo('.$key['id_usuario'].','.$id_torneo.');">ELIMINAR</span>';
							}
						}
						echo '<div class="linea"></div></li>';
					echo '</ul>';
					$i++;
				};
			echo '</div></div>';
			$tot_usuarios = sizeof($torneo);
			echo '<input type="hidden" id="tot_usuarios_torneo" value="'.($tot_usuarios+1).'" />';
	break;
	
	case 10: // FORM PARA CREAR TORNEO
		echo '<form id="buscar_torneo" name="buscar_torneo" action="" method="post">
            	<label for="nombre">Nombre del Torneo </label>
                <input id="torneo_input" name="torneo_input" type="text" />
                <input id="enviar" name="enviar" type="button" value="Crear" onclick="crear_torneo();" />
				<span></span>
            </form>';
	break;
	
	case 11: //JUGAR TORNEO
		mysql_("INSERT INTO torneos_usuarios (id_torneo, id_usuario, estado) VALUES ($id_torneo,$user_id,0)");
		echo '<div class="titulo">Pendientes de confirmaci&oacute;n</div>';
				$torneos_pendientes = torneos_usuario($user_id, 0);
				$i = 0; 
		foreach($torneos_pendientes as $key){
			echo '<div class="bloque_torneo">';
			echo '<div class="nombre">'.$key["nombre_torneo"].'</div>';
			echo '<div class="abandonar" onclick="abandonar_torneo('.$key["id"].','.$key["estado"].')"><img src="img/eliminar.png" alt="Eliminar" title="Abandonar torneo" /></div>';
			echo '</div>';
			$i++;
		}
	break;
	
	case 12: //CREAR TORNEO
		$rs = mysql_("SELECT nombre_torneo FROM torneos WHERE nombre_torneo = '$nombre_torneo'");
		$existe = mysql_num_rows($rs);
		if($existe){
			echo 'Nombre no disponible.';
		}
		else{
			mysql_("INSERT INTO torneos (nombre_torneo, id_usuario) VALUES ('$nombre_torneo',$user_id)");
			$id_torneo = mysql_insert_id();
			mysql_("INSERT INTO torneos_usuarios (id_torneo, id_usuario, estado) VALUES ($id_torneo,$user_id,1)");
			echo 'El torneo fue creado.';
		}
	break;
	
	case 13: //ABANDONAR TORNEO
		$rs = mysql_($query = "SELECT id FROM torneos WHERE id = $id_torneo AND id_usuario = $user_id");
		$existe = mysql_num_rows($rs);
		if($existe){
			mysql_("DELETE FROM torneos_usuarios WHERE id_torneo = $id_torneo");
			mysql_("DELETE FROM torneos WHERE id = $id_torneo");	
		}
		else{
			mysql_("DELETE FROM torneos_usuarios WHERE id_torneo = $id_torneo AND id_usuario = $user_id");
		}
	break;
	
	case 14: //MUESTRA LOS TORNEOS
		if($estado_torneo == 0){
			echo '<div class="titulo">Pendientes de confirmaci&oacute;n</div>';
					$torneos_pendientes = torneos_usuario($user_id, 0);
					$i = 0; 
			if(isset($torneos_pendientes)){
				foreach($torneos_pendientes as $key){
					echo '<div class="bloque_torneo">';
					echo '<div class="nombre">'.$key["nombre_torneo"].'</div>';
					echo '<div class="abandonar" onclick="abandonar_torneo('.$key["id"].','.$key["estado"].')"><img src="img/eliminar.png" alt="Eliminar" title="Abandonar torneo" /></div>';
					echo '</div>';
					$i++;
				}
			}
		}
		else{
			echo '<div class="titulo">Jugando</div>';
			$torneos_usuario = torneos_usuario($user_id, 1);
			$i = 0;
			foreach($torneos_usuario as $key){
				$torneo_id = $key["id"];
				echo '<div class="bloque_torneo"><div class="nombre">'.$key["nombre_torneo"];
				if($key["id_usuario"] == $user_id){
					echo ' <b>(A)</b>';
				}
				echo '</div>';
				echo '<div class="ir" onclick="mostrar_torneos('.$torneo_id.','.$user_id.',2)"><img src="img/ir.png" alt="ir" title="Ir a torneo" /></div>';
				if($key["id_usuario"] == $user_id){
					echo '<div class="abandonar" onclick="x=confirm(\'Est\u00e1s por eliminar el torneo '.$key["nombre_torneo"].'.\');if(x){abandonar_torneo('.$key["id"].','.$key["estado"].');};"><img src="img/eliminar.png" alt="Eliminar" title="Eliminar torneo" /></div>';
				}
				else{
					echo '<div class="abandonar" onclick="x=confirm(\'Est\u00e1s por abandonar el torneo '.$key["nombre_torneo"].'.\');if(x){abandonar_torneo('.$key["id"].','.$key["estado"].');};"><img src="img/eliminar.png" alt="Eliminar" title="Abandonar torneo" /></div>';
				}
				echo '</div>';
				$i++; 
			};
		}
	break;
	
	case 15: //CONFIRMA LA INSCRIPCIONDE DE UN USUARIO A UN TORNEO
		mysql_("UPDATE torneos_usuarios SET estado = 1 WHERE id_usuario = $id_usuario AND id_torneo = $id_torneo");
	break;
	
	case 16: //ELIMINA A UN USUARIO DE UN TORNEO
		mysql_("DELETE FROM torneos_usuarios WHERE id_torneo = $id_torneo AND id_usuario = $id_usuario");
	break;
	
	case 17: //EDITA LOS DATOS DEL PERFIL DEL USUARIO
		mysql_("UPDATE usuarios SET pass = '$pass', email = '$email' WHERE id = $user_id ");
		mysql_("UPDATE datos_usuarios SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', celular = '$celular', twitter = '$twitter', foto = '$foto_usuario' WHERE id_usuario = $user_id ");
	break;
	
	case 18: //RANKING
            if ($id_mes != "00" || $id_anio != "00") {
                $ranking = rankingMensual($categoria, $id_provincia, $id_mes, $id_anio);
            } else {
                $ranking = ranking($categoria, $id_provincia);
            }
            if (! empty($ranking)) {
                echo '<div id="top50">TOP 50</div>';
		echo ' <ul class="titulo">
			<li style="margin-right:10px">#</li>
			<li>Nombre</li>
			<li>Provincia</li>
			<li>Correctas</li>
			<li class="puntos">Puntos</li>
		</ul>';
		$i = 0;
		foreach($ranking as $key){
			echo '<ul class="datos">
				<li class="primero">'.($i+1).'</li>
				<li>'.$key['usuario'].'</li>
				<li>'.utf8_decode($key['provincia']).'</li>
				<li>'.$key['porcentaje'].'</li>
				<li class="puntos">'.$key['puntos'].'</li>
				<div class="linea"></div>
			</ul>';
			$i++;
		}
            } else {
                echo '<div id="noHayResultados">No hay resultados para este período</div>';
            }
		
	break;
}
?>