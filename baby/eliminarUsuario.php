<?php 
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos
//$conn=get_db_conn();
$idUsuarios=$_GET['idUsu'];
$idEstado=$_GET['idEst'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eliminar Usuario</title>

		<link type="text/css" href="css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        <link type="text/css" href="css/estilo.css" rel="StyleSheet" />
        
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
        
        <script type="text/javascript">

			$(function(){	
				
				// Accordion
				$("#accordion").accordion({ header: "h3" });
	
				// Tabs
				$('#tabs').tabs();
				
				//boton
				$( "input:submit, a, button", ".demo" ).button();
				$( "a", ".demo" ).click(function() { return true; });

				// Dialog			
				$('#dialog').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});
				
				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				
				$( "#dialog-message" ).dialog({
					modal: true,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
				
			});
		</script>


</head>

<?php include_once './cabecera.php'; ?>
    
<div class="demo" align="center">

<?php 

//echo $idUsuarios;
if($idEstado==0){
	$actuEstado=mysql_query("UPDATE usuarios SET estado = 1 WHERE id = $idUsuarios") or die("Problemas en el update:".mysql_error());
}
elseif($idEstado==1){
	$actuEstado=mysql_query("UPDATE usuarios SET estado = 0 WHERE id = $idUsuarios") or die("Problemas en el update:".mysql_error());
}

?>

  <h1>El usuario ahora está 
      <?php  if ($idEstado==0){ echo "activo"; } else { echo "inactivo"; } ?>
  </h1>

<DIV class="demo"  align="center">
    
    <table border="0" width="500">  
      
      <tr align="center">
           <td><h4>Para ver la lista de Usuarios presiona en el boton Ver Usuarios. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="verUsuarios.php">Ver Usuarios</a> </td>
      </tr>
      
      <tr align="center">
           <td><h4>Para volver al Menu Principal presiona en el boton Volver al Menu Principal. </h4></td>
      </tr>
      
      <tr align="center">
        <td> <a href="index.php">Volver al Menu Principal</a> </td>
      </tr>
      
    </table>
	
 </DIV>

</div>

 <br /><br />	
 <!-- Comienzo del DIV pie -->
    <div id="pie2">
    	   	Yo sé más que vos &copy - Todos los derechos reservados - 2012 <br />
         	<a href="http://www.yosemasquevos.com">www.yosemasquevos.com</a>    
    </div>
    <!-- Fin del DIV pie -->

</html>