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

    <?php include_once './cabecera.php'; ?>    
    
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