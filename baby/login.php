<?php
include '../constantes.php';

$cnx = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($db, $cnx);
mysql_query("SET NAMES 'utf8'");

if (!isset($_SESSION)) {
	session_start();
}
?>
<?php
if(!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
	  if(PHP_VERSION < 6){
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	  }
	
	  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
	  switch($theType){
		case "text":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;    
		case "long":
		case "int":
		  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
		  break;
		case "double":
		  $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
		  break;
		case "date":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;
		case "defined":
		  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
		  break;
	  }
	  return $theValue;
	}
}

if (isset($_POST['admin']) && $_POST['admin'] != "") {
	$usuario=$_POST['admin'];
	$pass=$_POST['pass'];
	
	$query=sprintf("SELECT quien, sos FROM baby_admin WHERE quien=%s AND sos=%s",
	GetSQLValueString($usuario, "text"), GetSQLValueString($pass, "text")); 
	
	$rs = mysql_query($query, $cnx) or die(mysql_error());
	$usuarios = mysql_num_rows($rs);
	if ($usuarios) {
		//declaro las variables de sesión.
		$_SESSION['admin'] = $usuario;
		$_SESSION['pass_admin'] = $pass;
		header('location:index.php');
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Log-in</title>
        
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
	if($_POST['admin'] == ""){
		?>
			<script type="text/javascript"> alert('Ten\u00e9s que completar el nombre del Administrador.');</script>
		<?php
	}
	elseif($_POST['pass'] == ""){
		?>
			<script type="text/javascript"> alert('Ten\u00e9s que completar el password.');</script>
		<?php
	}
}
	
	?>
            <div id="cabecera">
      <table width="100%">        
    <tr>
      <td width="15%">
      	<div id="logo">	<a href="index.php"> <img src="img/logo.png" alt="Yo sé más que vos" title="Yo sé más que vos" /> </a> </div>
      </td>
      <td width="60%">
      	 </td>
                    
     <td width="15%">
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
            <td width="100%"> <div style="text-align:center;"> Administrador - Log in  </div> </td>
    	</tr>
    </table>
    </div>
    
    
    	<div class="demo" align="center"> 
			<div class="demo_jui">
    
<FORM ACTION="login.php" METHOD="post">
  <table cellspacing="3" cellpadding="3">
    
    <tr>
      <td align="right">Administrador:</td>
      <td colspan="5"><input TYPE="text" name="admin" maxlength="20" SIZE=20 /> </td>
    </tr>
    <tr>
       
      <td align="right">Password:</td>
      <td ><INPUT TYPE="text" NAME="pass" ID="pass" SIZE=20 MAXLENGTH="20" value="" /></td>
      
      <tr>
    <td colspan="2" align="center"><input name="cargarAdmin" type="submit" class="boton" value="Ingresar" /></td>
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