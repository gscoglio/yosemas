<?php
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos 
//$conn=get_db_conn();
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Ver Usuarios</title>
        
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
    
    
    	<div class="demo" style="width:100%"> 
        
        <h2 align="center"> Lista de Usuarios  </h2>
			
			 
			<div class="demo_jui">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
        <thead>
            <tr>
        	<th>Numero de Usuario</th>
			<th>Nombre de Usuario</th>
			<th>Documento</th>
			<th>Email</th>
            <th>Puntos</th>
			<th>Estado</th>
            <th>Eliminar Usuario</th>
            
			
		</tr>
	</thead>
    
   
	<tbody>

<?php

$datosUsuarios = mysql_query("SELECT Us.*, DU.dni FROM usuarios Us
								INNER JOIN datos_usuarios DU ON DU.id_usuario = Us.id") or die("Problemas en el select:".mysql_error());

while($reg = mysql_fetch_array($datosUsuarios)) {
				
				$id_usu= $reg['id']; 
				$nick=$reg['usuario']; 
				$estado=$reg['estado']; 
				$email=$reg['email']; 
				$doc=$reg['dni'];
				
			
			$regUsuario = mysql_query("SELECT * FROM puntaje WHERE id_usuario=$id_usu AND id_categoria = 1") or die("Problemas en el select:".mysql_error());
				while($reg2 = mysql_fetch_array($regUsuario)) {
					$punt=$reg2['puntos']; 	
				}

?>

	<tr class="gradeC">
			<td class="center"><?php echo $id_usu ?></td>
            <td class="center"><?php echo $nick ?></td>
            <td class="center"><?php echo $doc ?></td>
			<td class="center"><?php echo $email ?></td>
            <td class="center"><?php echo $punt ?></td>
            <td class="center"><?php 
				if($estado==1){
					echo 'Activo';	
				}
				else{
					echo '<span style="color:#f00;">Bloqueado</span>';	
				}
			?></td>
			<td class="center"><a href="eliminarUsuario.php?idUsu=<?php  echo $id_usu ?>&idEst=<?php echo $estado; ?>">[Cambiar Estado]</a></td>
			
		</tr>
        
<?php }?>
		
	</tbody>
</table> 
<br><br>	
			
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