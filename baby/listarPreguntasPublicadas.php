<?php
include('cnx.php'); // incluimos el archivo de conexión a la Base de Datos 
include('estado_preguntas.php');
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        
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
						 
						"sLengthMenu": "Mostrar _MENU_ preguntas por pagina",
           				"sZeroRecords": "No hay preguntas para mostrar",
            			"sInfo": "Mostrando _START_ de _END_ de _TOTAL_ preguntas",
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
    
    <?php include_once './cabecera.php'; ?>

		<div style="width:100%">
        		
            <h2 align="center"> Lista De Preguntas en el Estado Publicadas </h2>
				 
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
        <thead>
            <tr>
        	<th>Numero</th>
			<th>Pregunta</th>
			<th>Puntos</th>
			<th>Categoria</th>
			<th>Autor</th>
            <th>Comenzo el</th>
            <th>Finaliza el</th>
            <th>Acciones</th>
			
		</tr>
	</thead>
    
	<tbody>

<?php

$estado = 2;

$ssql="SELECT Pr.*, Ca.categoria FROM preguntas Pr
				INNER JOIN categorias Ca ON Ca.id = Pr.id_categoria
				WHERE estado='".$estado."' ";
		$registros = mysql_query($ssql, $cnx) or die("Problemas en el select:".mysql_error());
		
		
		while($reg = mysql_fetch_array($registros)) {
			
			$id_preg= $reg['id'];
			$preg=$reg['pregunta'];
			$punt=$reg['puntos'];
			$cate=$reg['categoria'];
			$auto=$reg['autor'];
			$fechaCom = date_time($reg['fecha_inicio']);
			$fechaFi = date_time($reg['fecha_fin']);
			$est=$reg['estado'];
		
		?>
		
			<tr class="odd gradeX" >
			
					<td class="center"><?php echo $id_preg ?></td>
					<td ><?php echo $preg ?></td>
					<td class="center"><?php echo $punt ?></td>
					<td class="center"><?php echo $cate;?></td>
					<td class="center"><?php echo $auto ?></td>
					<td class="center"><?php echo $fechaCom ?></td>
					<td class="center"><?php echo $fechaFi ?></td>
           			<td class="center"><a href="accionesRespuestaPublicada.php?idPreg=<?php  echo $id_preg; ?> ">[Ver y Modificar]</a></td>
					 </td>
					
				</tr>
				
		<?php } ?>		
	</tbody>
</table>	
			<br><br>                       
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