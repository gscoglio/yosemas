<?php 
ini_set("memory_limit","48M");
if($_POST){
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
				}else{
					//echo 'error, no supera el minimo esperado';	
				}
			}
		}
	}
}
?>