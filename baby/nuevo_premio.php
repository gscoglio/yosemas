<?php
include('cnx.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Premios</title>
		
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/jquery.dataTables_themeroller.css";
			@import "examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
		</style>
        
      <link type="text/css" href="css/estilo.css" rel="StyleSheet" />  
                
		<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
        
       <style type="text/css">
	   #bloque_novedad
	   {
		   position:relative;
		   width:100%;
	   }
	    #form_nueva_novedad
		{
			width:400px;
			position:relative;
			margin:0 auto;	
			padding:10px 0;
		}
		#form_nueva_novedad .block
		{
			padding:10px 0;
		}
	   </style>
	</head>
	
    <body>
	
    <div id="cabecera">
      <table width="100%">        
    <tr>
      <td width="15%">
      	<div id="logo">	<a href="index.php"> <img src="img/logo.png" alt="Yo sé más que vos" title="Yo sé más que vos" /> </a> </div>
      </td>
      <td width="77%">
      	 
       <table align="center" cellpadding="15px" >
           	<tr>
                 <td>  
                 <div id="menu2">   
                 <table>
                 <tr>
                 	<td><li class="mp"><a href="index.php">Cargar Una Pregunta</a> </td>
                    <td><li class="mp"><a href="listarPreguntasCreadas.php">Ver Preguntas Creadas</a></td>
                    <td><li class="mp"><a href="listarPreguntasPublicadas.php">Ver Preguntas Publicadas</a></td>
                    <td><li class="mp"><a href="listarPreguntasFinalizadas.php">Ver Preguntas Finalizadas</a></td>
                 	<td><li class="mp"><a href="novedades.php">Novedades</a></td>
                 </tr>   
                 <tr>   
                    <td><li class="mp"><a href="listarPreguntasRespondidas.php">Ver Preguntas Respondida</a></td>
                    <td><li class="mp"><a href="verUsuarios.php">Ver Usuarios</a></td>
                    <td><li class="mp"><a href="verTorneos.php">Ver Torneos de Amigos</a></td>
                    <td><li class="mp"><a href="admin.php">Crear un Administrador</a></td>
                    <td><li class="mp"><a href="premios.php">Premios</a></td>
          		</tr> 
       			</table>
                </div>
              	</td>
            </tr>
        </table>
     </td>
    
     <td width="8%">
		<div id="redesSociales">
            <a href="http://www.facebook.com" target="_blank">
            <img src="img/face1.png" alt="Seguinos en Facebook" title="Seguinos en Facebook"  onmouseover="this.src='img/face2.png';" 
            onmouseout="this.src='img/face1.png';"/> 
            </a>
            <a href="https://twitter.com/yosemasquevos" target="_blank">
            <img src="img/twitter1.png" alt="Seguinos en Twitter" title="Seguinos en Twitter" onmouseover="this.src='img/twitter2.png';" 
            onmouseout="this.src='img/twitter1.png';"/> 
            </a> 
         </div>     
     </td>
    </tr>
   </table>
 	</div>
    
    <div id="barra">
    <table border="0" width="100%" height="42px">
    	<tr>
            <td width="20%"> <div id="user"> Administrador  </div> </td>
            <td width="60%"> </td>		
            <td width="20%"> <div id="exit"> <a href="logout.php">Salir</a> </div> </td>
    	</tr>
    </table>
    </div>
    <div id="bloque_novedad">
    <br>
    	<a href="premios.php" style="margin:30px; font-weight:bold;"><< Volver a Premios</a>
        <?php 
		if(isset($_GET['editar']) && $_GET['editar'] == 1){
			$id = $_GET['id'];
			$query = "SELECT * FROM premios WHERE id = $id";
			$rs = mysql_query($query,$cnx);
			$row_datos = mysql_fetch_assoc($rs);
		?>
        <form id="form_nueva_novedad" name="form_nueva_novedad" enctype="multipart/form-data" action="guardar_premios.php?accion=2" method="post">     
            <div class="block">T&iacute;tulo: <input type="text" id="titulo" name="titulo" style="font-size:16px; width:400px;" value="<?php echo $row_datos['titulo']; ?>" /></div>
            <div class="block">Texto: <textarea rows="10" cols="70" id="texto" name="texto"><?php echo $row_datos['texto']; ?></textarea></div>
            <div class="block">Cambiar Imagen: <input type="file" name="foto" id="foto" /></div>
            <input type="hidden" id="foto_orig" name="foto_orig" value="<?php echo $row_datos['imagen']; ?>" />
            <input type="hidden" id="id" name="id" value="<?php echo $row_datos['id']; ?>" />
            <input type="submit" name="enviar" id="enviar" value="Guardar" />
        </form> 
        <?php
        }
        else{
		?>
        <form id="form_nueva_novedad" name="form_nueva_novedad" enctype="multipart/form-data" action="guardar_premios.php?accion=1" method="post">  
            <div class="block">T&iacute;tulo: <input type="text" id="titulo" style="font-size:16px; width:400px;" name="titulo" /></div>
            <div class="block">Texto: <textarea rows="10" cols="70" id="texto" name="texto"></textarea></div>
            <div class="block">Seleccionar Imagen: <input type="file" name="foto" id="foto" /></div>
            <input type="submit" name="enviar" id="enviar" value="Guardar" />
        </form> 
        <?php
        }
		?>
    </div>
    <br><br>     
    <!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
    <!-- Fin del DIV pie -->
        
    <script type="text/javascript">
		$('#form_nueva_novedad #foto').change(function() { 
		$.ajax({
		type: "POST",
		url: "imagen.php",
		data: { 'operacion': 3, 'id_pregunta': id_pregunta, 'id_respuesta': id_respuesta, 'user': id_usuario }
		}).done(function() {
			
		}); 
		$('#marco_foto img').attr('src','');
	});
	</script>
	</body>
</html>