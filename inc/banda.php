<?php
if(isset($_SESSION['usuario'])){
	$user = $_SESSION['usuario'];
	$user = strtolower($user);
	$user = ucwords($user);
    echo '<a href="perfil.php" id="nombre_usuario">'.$user.'</a>';
	$page_name = curPageName();
	if($page_name == 'torneos.php'){
		echo '<div id="btn_banda"><a href="#" id="buscar_torneo" onclick="mostrar_torneos(0, 10, 1)">Buscar</a><a href="#" id="crear_torneo" onclick="mostrar_torneos(0, 10, 3)">Crear</a></div>';
	}
	echo '<a href="logout.php" id="salir">Salir</a>';
}
else{
?>
	<form action="" id="formLogin" name="formLogin" method="post">
    	<div class="bloque">
			<label for="usuario">Usuario o email </label><input tabindex="1" maxlength="50" type="text" name="usuario" id="usuario" />
        </div>
        <div class="bloque">
			<label for="pass">Contrase&ntilde;a </label><input tabindex="2" maxlength="8" type="password" name="pass" id="pass" />
        </div>
    
    <div class="bloque">
    	<input type="submit" class="btn_form_banda" id="enviar" name="enviar" value="Ingresar" />
        <span onclick="window.location = 'recuperarpass.php';" id="olvidaste">&iquest;Olvidaste tu contraseña?</span>
    </div>
    </form>
	<div id="error_login">Usuario o contrase&ntilde;a incorrectos.</div>
	<a href="registrar.php" id="registrate">Registrate</a>
<?php
}
?>
	