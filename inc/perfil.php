<?php 
if(isset($_SESSION['usuario'])){
	$row_perfil = perfil($_SESSION['id']);?>
    <article id="perfil">
        <div id="foto">
            <?php echo '<img src="fotos/'.$row_perfil['foto'].'" alt="'.$row_perfil['usuario'].'"/>'; ?>
        </div>
        <div id="datos_puestos">
            <div class="datos">
                <?php echo 'Puesto General<br /><span>#'.$row_perfil['pos_general'].'</span>'; ?>
            </div>
            <div class="datos">
                <?php echo utf8_decode($row_perfil['provincia']).'<br /><span>#'.$row_perfil['pos_provincia'].'</span>'; ?>
            </div>
        </div>
        <div class="datos" style="margin-bottom:0; width:220px; display:inline-block;">
            <?php echo 'Puntos: <span>'.$row_perfil['puntos'].'</span>'; ?>
        </div>
    </article>
    <article id="placa_torneos"></article>
<?php 
}
else{ ?>
	<div id="registrate_texto"><p>Ingres&aacute; o <a href="registrar.php">Registrate.</a></p><p>Demostr&aacute; que sos el que m&aacute;s sabe de todo.</p></div>	
<?php } ?>