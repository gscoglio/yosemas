<?php
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos 
include('estado_preguntas.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
						 
						"sLengthMenu": "Mostrar _MENU_ torneos por pagina",
           				"sZeroRecords": "No hay torneos para mostrar",
            			"sInfo": "Mostrando _START_ de _END_ de _TOTAL_ torneos",
            			"sInfoFiltered": "",
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
    
    <title>Yo sé más que vos - Administración</title>
	    
    <script type="text/javascript" src="js/corner.js"></script>
        
	<script type="text/javascript">
			$(function(){
				//boton
				$( "input:submit, a, button", ".demo" ).button();
				$( "a", ".demo" ).click(function() { return false; });
			});
	</script> 
	
	<script type="text/javascript">
    	$("#menu2").corner("");  
		$(".mp").corner("");  	      
    </script>
    
</head>

<body>
	
    <!-- Comienzo del DIV cabecera -->
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
                    <td><li class="mp"><a href="listarPreguntasCreadas.php" >Ver Preguntas Creadas</a></td>
                    <td><li class="mp"><a href="listarPreguntasPublicadas.php" >Ver Preguntas Publicadas</a></td>
                    <td><li class="mp"><a href="listarPreguntasFinalizadas.php" >Ver Preguntas Finalizadas</a></td>
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
    <!-- Fin del DIV cabecera -->
        
    <!-- Comienzo del DIV barra -->
	<div id="barra">
    <table border="0" width="100%" height="42px">
    	<tr>
            <td width="20%"> <div id="user"> Administrador  </div> </td>
            <td width="60%"> </td>		
            <td width="20%"> <div id="exit"> <a href="logout.php">Salir</a> </div> </td>
    	</tr>
    </table>
    </div>
    <!-- Fin del DIV barra -->
        
     <!-- Comienzo del DIV cuerpo -->
    <div id="cuerpo" align="center">
    	<div class="demo" style="width:100%">        
            <h2 align="center"> Lista de Torneos </h2>
			
			 <div class="demo_jui">
    		 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
        		<thead>
         			<tr>
        				<th>Numero del Torneo</th>
                        <th>Nombre del Torneo</th>
                        <th>Creado por</th>
                        <th>Eliminar Torneo</th>
					</tr>
				</thead>  
				
                <tbody>
				<?php
					$datosTorneo = mysql_query("SELECT * FROM torneos") or die("Problemas en el select:".mysql_error());
					while($reg = mysql_fetch_array($datosTorneo)) {
				
					$id_torneo= $reg['id'];
					$nom_torneo=$reg['nombre_torneo']; 
					$creado=$reg['id_usuario']; 
				?>

				<tr class="gradeC">
   					<td class="center"><?php echo $id_torneo ?></td>
        		    <td class="center"><?php echo $nom_torneo ?></td>
					<td class="center"><?php 
						$datosUsuarios = mysql_query("SELECT * FROM usuarios WHERE id=$creado") or die("Problemas en el select:".mysql_error());
			
						while($reg2 = mysql_fetch_array($datosUsuarios)) {
								$nick=$reg2['usuario']; 
						}
			
						echo $nick; 
				?></td>
				<td class="center"><a href="eliminarTorneo.php?idTor=<?php  echo $id_torneo ?>">[Eliminar]</a></td>
			</tr>
        <?php } ?>
		
			</tbody>
	</table>	

	<br><br> 
</div>
</div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    	         
	</div>
    <!-- Fin del DIV cuerpo -->
        
             
    <!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
    <!-- Fin del DIV pie -->
    
    
</body>
</html>
