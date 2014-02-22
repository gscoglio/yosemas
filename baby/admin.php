<?php
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos 
//$conn=get_db_conn();
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Crear administrador</title>
        
       <style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/jquery.dataTables_themeroller.css";
			@import "examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
		</style>
        
        <link type="text/css" href="css/estilo.css" rel="StyleSheet" />
                
		<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
       
		<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {
				
				$('#example').dataTable({
					
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					
					 "oLanguage": {
						 
						"sLengthMenu": "Mostrar _MENU_ usuarios por pagina",
           				"sZeroRecords": "No hay usuarios creados",
            			"sInfo": "Mostrando _START_ de _END_ de _TOTAL_ usuarios",
            			"sInfoFiltered": "(filtered from _MAX_ total records)",
						"sSearch": "Buscar:",
        			
							 "oPaginate": {
								"sFirst": "Primer",
								"sLast": "Ultima",
								"sPrevious": "Anterior",
        						"sNext": "Siguiente",
      							}
					}			
				});
			} );
		</script>
	</head>
	
    <body>
    <?php
	if(isset($_POST['cargarAdmin'])){
		if(isset($_POST['admin']) && $_POST['admin'] != ""){
			if(isset($_POST['pass']) && $_POST['pass'] != ""){
				$admin = $_POST['admin'];
				$pass = $_POST['pass'];
				$nuevo_admin = mysql_query("INSERT INTO baby_admin (quien,sos) VALUES ('".$admin."', '".$pass."')");	
			}
			else{ ?>
				<script type="text/javascript"> alert('Ten\u00e9s que completar el password.');</script>
            <?php }	
		}
		else{ ?>
			<script type="text/javascript"> alert('Ten\u00e9s que completar el nombre del Administrador.');</script>
		<?php }
	}
	?>
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
    
    
    	<div class="demo" align="center"> 
        
        <h2 align="center"> Nuevo Administrador </h2>
			
			 
			<div class="demo_jui">
    
<FORM ACTION="admin.php" METHOD="post">
  <table cellspacing="3" cellpadding="3">
    
    <tr>
      <td align="right">Administrador:</td>
      <td colspan="5"><input TYPE="text" name="admin" maxlength="20" SIZE=20 /> </td>
    </tr>
    <tr>
       
      <td align="right">Password:</td>
      <td ><INPUT TYPE="text" NAME="pass" ID="pass" SIZE=20 MAXLENGTH="20" value="" /></td>
      
      <tr>
    <td colspan="2" align="center"><input name="cargarAdmin" type="submit" class="boton" value="Crear Administrador" /></td>
    </tr>
    </table>
  <br /><br />
</FORM>
			
			</div>
		</div>
        
    <br><br> 	
    <!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
    <!-- Fin del DIV pie -->  
       
	</body>
</html>