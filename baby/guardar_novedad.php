<?php
include('cnx.php');
if(isset($_POST['fecha'])){$fecha = $_POST['fecha'];}
if(isset($_POST['titulo'])){$titulo = $_POST['titulo'];}
if(isset($_POST['texto'])){$texto = $_POST['texto'];}
?>
<?php
ini_set("memory_limit","48M");
if($_FILES['foto']['size'] > (1024000)) {
	echo 'Error al intentar subir la imagen.<br />';
	echo 'El tamaño del archivo debe ser menor a 1MB.<br />';
	echo '<a href="novedades.php">Volver a novedades</a>';
	exit;
}
if($_FILES['foto']['size'] > 0){
	$nombre = date("U");
	$directorio_guardar = '../img/novedades/'.$nombre.'.jpg';
	$extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
	if($extension == 'jpg'){
		$directorio_ruta = '../img/novedades/'.$nombre.'.jpg';
	}
	elseif($extension == 'png'){
		$directorio_ruta = '../img/novedades/'.$nombre.'.png';
	}
	
	if(!@(move_uploaded_file($_FILES['foto']['tmp_name'],$directorio_ruta))){
		echo 'error al intentar crear la imagen<br />';
		echo '<a href="premios.php">Volver a premios</a>';	
		exit;
	}else{
		$ancho_maximo = 120; // coloco aca el ancho maximo
		$alto_maximo = 120;  // coloco aca el alto maximo
		$imagen = $directorio_ruta;
		$im = NULL;
		if(stristr($imagen, '.jpg')){
			$im = @imagecreatefromjpeg($imagen);
		}
		elseif(stristr($imagen, '.png')){
			$im = @imagecreatefrompng($imagen);
		}
		if($im == ''){
			echo 'Error al intentar guardar la imagen.<br />';
			echo 'La compresión del archivo no es v&aacute;lida.<br />';
			echo '<a href="novedades.php">Volver a novedades</a>';
			exit;
		}
		if($im !== NULL){
			if(@imagesx($im) < $ancho_maximo){
				echo 'Error al intentar guardar la imagen.<br />';
				echo 'El ancho de la imagen debe superar los 120px.<br />';
				echo '<a href="novedades.php">Volver a novedades</a>';
				exit;
			}
			if(@imagesx($im) < @imagesy($im)){
				echo 'Error al intentar guardar la imagen.<br />';
				echo 'La imagen no puede ser m&aacute;s alta que ancha.<br />';
				echo '<a href="novedades.php">Volver a novedades</a>';
				exit;
			}
			if ((@imagesx($im) >= $ancho_maximo) or (@imagesy($im) >= $alto_maximo)){
				if(imagesx($im) > imagesy($im)){
					$alto = imagesy($im) * $ancho_maximo / imagesx($im);
					$dest = imagecreatetruecolor($ancho_maximo, $alto);
					imagecopyresampled($dest, $im, 0, 0, 0, 0, $ancho_maximo, $alto, imagesx($im), imagesy($im));
					imagejpeg($dest, $directorio_guardar, 100);
					chmod($directorio_guardar,0777);
					imagedestroy($dest);
					//echo 'se modifico al ancho maximo.<br />';
						
				}elseif(imagesy($im) > imagesx($im)){
					$ancho = imagesx($im) * $alto_maximo / imagesy($im);
					$dest = imagecreatetruecolor($ancho, $alto_maximo);
					imagecopyresampled($dest, $im, 0, 0, 0, 0, $ancho, $alto_maximo, imagesx($im), imagesy($im));
					imagejpeg($dest, $directorio_guardar, 100);
					chmod($directorio_guardar,0777);
					imagedestroy($dest);
					//echo 'se modifico al alto maximo.<br />';
				}else{
					$ancho = imagesx($im) * $alto_maximo / imagesy($im);
					$alto = $alto_maximo;
					$dest = imagecreatetruecolor($ancho, $alto);
					imagecopyresampled($dest, $im, 0, 0, 0, 0, $ancho, $alto, imagesx($im), imagesy($im));
					imagejpeg($dest, $directorio_guardar, 100);
					chmod($directorio_guardar,0777);
					imagedestroy($dest);
					//echo 'se modifico al alto y ancho maximo.<br />';
				}
					$nombre_imagen = $nombre.'.jpg';
			}else{
				//echo 'error, no supera el minimo esperado';	
			}
		}
	}
}
else{
	if(isset($_POST['foto_orig'])){
		$nombre_imagen = $_POST['foto_orig'];
	}
	else{
		$nombre_imagen = 'default.jpg';
	}
}
if($_GET['accion'] == 1){
	$query = "INSERT INTO novedades (fecha, titulo, texto, imagen) VALUES ('$fecha', '$titulo', '$texto', '$nombre_imagen')";
}
elseif($_GET['accion'] == 2){
	$id = $_POST['id'];
	$query = "UPDATE novedades SET fecha='$fecha', titulo='$titulo', texto='$texto', imagen='$nombre_imagen' WHERE id = $id";
}
$rs = mysql_query($query, $cnx);

@header('location: novedades.php');
?>