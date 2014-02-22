<?php
	require_once('cnx.php');
	require_once('funciones.php');
	require_once('seguridad.php');
	require_once('estado_preguntas.php');

	$resp = preguntas($user_id, 1);
	$preguntas = $resp[0];
	$respuestas = $resp[1];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yo s&eacute; m&aacute;s que vos</title>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="css/estilos.css" />
</head>
<body>
<div id="contenido">
	<header id="header">
    	<?php include('inc/header.php'); ?>
    </header>
    <div id="banda">
		<?php include('inc/banda.php'); ?>
    </div>
    <div id="centro">
        <section id="datos_usuario">
			<?php include('inc/perfil.php'); ?>
            <div id="sugerir_pregunta">
                <div class="titulo">Sugerinos una Pregunta</div>
                <form id="form_sugerir" name="form_sugerir" action="" method="post">
                    <label for="categoria" id="etiqueta">Categor&iacute;a: </label><select id="categoria" name="categoria" size="1" onchange="var x = $('#categoria_val').val();categoria(x)">
                        <option value="0"></option>
                        <?php
                        $categoria = get_categoria();
                        $tot_categoria = sizeof($categoria);
                        do{
                            static $i = 0;
                            $i++;
                            echo '<option value="'.$categoria[$i]['categoria'].'">'.$categoria[$i]['categoria'].'</option>';
                        }while($i < $tot_categoria);
                        ?>
                    </select>
                    <textarea id="pregunta" name="pregunta" ></textarea>
                    <input id="enviar" name="enviar" class="btn_form" type="button" value="Enviar" onclick="validar_sugerir()" />
                </form>
            </div>
        </section>
        <nav>
			<?php include('inc/btn_categorias.php'); ?>
        </nav>
        <section id="info">
        	<?php for($i=0; $i < count($preguntas); $i++){ ?>
        	<article class="pregunta" <?php if($i == (count($preguntas) - 1)){echo 'style="margin-bottom:0;"';} ?>>
            	<div class="info_pregunta">
                    <div class="titulo" style="border-bottom:2px solid <?php echo color($preguntas[$i]['id_categoria']); ?>;">
                        &iquest;<?php echo $preguntas[$i]['pregunta']; ?>?
                    </div>
                    <div class="respuestas">
                    <?php for($j=0; $j < count($respuestas[$i]); $j++){ ?>
                    <div class="opcion">
                    	<input type="radio" name="respuesta<?php echo $i; ?>" value="<?php echo $respuestas[$i][$j]['id_respuesta']; ?>" />
						<?php echo $respuestas[$i][$j]['respuesta']; ?>
                    </div>
                    <?php } ?>
                    </div>
                </div>
                <?php 
					$fecha = explode(' ',$preguntas[$i]['fecha_fin']);
					$hora = $fecha[1];
					$fecha = $fecha[0];
					$fecha = explode('-',$fecha);
					$hora = explode(':',$hora);
				?>
                <div class="placa" style="background-color:<?php echo color($preguntas[$i]['id_categoria']); ?>;">
                    <div class="vencimiento">Vencimiento<br /><span><?php echo $fecha[2].'/'.$fecha[1].'/'.$fecha[0].' '.$hora[0].':'.$hora[1]; ?></span></div>
                    <div class="puntos">Puntos<br /><span><?php echo $preguntas[$i]['puntos']; ?></span></div>
                    <div class="autor">Autor<br /><span><?php echo $preguntas[$i]['autor']; ?></span></div>
                    <div class="responder color_<?php echo $preguntas[$i]['id_categoria']; ?>" onclick="validar_respuesta(<?php echo $preguntas[$i]['id']; ?>, <?php echo $i; ?>,<?php echo $user_id; ?>)">Responder</div>
                </div>
            </article>
            <?php } ?>
            <input type="hidden" id="categoria" name="categoria" value="1" />
        </section>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
</div>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript">
var pagina = 'preguntas';
$('#botonera_ppal #preguntas a').css({
		'color': btn_select
});
</script>
</body>
</html>