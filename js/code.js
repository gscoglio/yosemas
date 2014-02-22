document.createElement("root");
document.createElement("article");  
document.createElement("footer");  
document.createElement("header");  
document.createElement("nav");  

var btn_color = '#111';
var btn_select = '#1a1';
var btn_over = '#aaa';
var categoria_color = 1;

$(document).ready(function(){	
$('#formLogin .bloque #pass').keydown(function(e) {
    var code = e.keyCode || e.which;
    if (code == '9') {
    	e.preventDefault(); 
    	$('.btn_form_banda').focus();
    }
	else if (code == '13') {
    	form_submit();
    }
});
$('#formLogin .btn_form_banda').keydown(function(e) {
    var code = e.keyCode || e.which;
    if (code == '13') {
    	form_submit();
    }
});

//BOTONERA CATEGORIAS
	$('.btn_pregunta img').bind({
		'mouseover': function(){
				var btn = $(this).attr('src');
				btn = btn.split('_',2);
				btn[1] = btn[1].split('.',1);
				$(this).attr('src',btn[0]+'_'+btn[1]+ '_over.png');
			},
		'mouseout': function(){
				var color = $('#banda').css('background-color');
				var btn = $(this).attr('src');
				btn = btn.split('_',2);
				if(window.categoria_color == 1){
					$(this).attr('src',btn[0]+'_'+btn[1]+ '_.png');
				}
				else{
					$(this).attr('src',btn[0]+'_'+btn[1]+ '_gris.png');
					switch(window.categoria_color){  
						case 2: 
							$('#btn_deportes img').attr('src','img/btn_deportes_.png'); 
							break;  
						case 3: 
							$('#btn_politica img').attr('src','img/btn_politica_.png');
							break;  
						case 4: 
							$('#btn_misc img').attr('src','img/btn_misc_.png');
							break;  
						case 5: 
							$('#btn_espectaculos img').attr('src','img/btn_espectaculos_.png'); 
							break;
					}
				}
			},
		'click': function(){
				var btn = $(this).attr('src');
				if(btn == 'img/btn_todas_over.png'){
					$('#btn_deportes img').attr('src','img/btn_deportes_.png');
					$('#btn_politica img').attr('src','img/btn_politica_.png');
					$('#btn_espectaculos img').attr('src','img/btn_espectaculos_.png');
					$('#btn_misc img').attr('src','img/btn_misc_.png');
					$(this).attr('src', btn);
				}
				else{
					$('#btn_todas img').attr('src','img/btn_todas_gris.png');
					$('#btn_deportes img').attr('src','img/btn_deportes_gris.png');
					$('#btn_politica img').attr('src','img/btn_politica_gris.png');
					$('#btn_espectaculos img').attr('src','img/btn_espectaculos_gris.png');
					$('#btn_misc img').attr('src','img/btn_misc_gris.png');
					$(this).attr('src', btn);
				}
				
			}
	})
		
//BOTONES FACEBOOK Y TWITTER
	$('#face_tweet img').hover(
		function(){
			var src = $(this).attr('src');
			src = src.split('_',1);
			$(this).attr('src', src+'.png');
		},
		function(){
			var src = $(this).attr('src');
			src = src.split('.',1);
			$(this).attr('src', src+'_grey.png');
		}
	);

//CAMBIAR IMAGEN	
	$('#form_foto').ajaxForm(function(msg) { 
		$('#form_foto img').attr('src','fotos/'+msg)
		if(window.location.href.match('registrar.php')){
			$('#form_registro #foto_usuario').attr('value',msg);
		}
		if(window.location.href.match('perfil_editar.php')){
			$('#form_perfil #foto_usuario').attr('value',msg);
		}
	});
	$('#cambiar_foto').click(function() {
		$('#form_foto input[type=file]').click();
	});
	$('#form_foto #foto').change(function() {  
		$('#form_foto').submit();
	});
	
//DATEPICKER
	$('#nacimiento').DatePicker({
		eventName: 'focus',
		view: 'years',
		format:'d/m/Y',
		date: $('#nacimiento').val(),
		current: $('#nacimiento').val(),
		starts: 1,
		//position: 'r',
		onBeforeShow: function(){
			$('#nacimiento').DatePickerSetDate($('#nacimiento').val(), true);
		},
		onChange: function(formated, dates){
			$('#nacimiento').val(formated);
			if($('#nacimiento').val() == $('#hoy').val()){
				$('#nacimiento').css('color','#fff');
			}
			else{
				$('#nacimiento').css('color','#000');
			}
			//$('#nacimiento').DatePickerHide();
		}
	});

	document.getElementById("provincia").selectedIndex = -1;
	document.getElementById("sexo").selectedIndex = -1;
});
function color(categoria){	
	switch(categoria){
		case 1:
			return '#4a4a4a';
		break; 
		
		case 2:
			return '#67c184';
		break;
		
		case 3:
			return '#66a3c1';
		break;
		
		case 4:
			return '#c1c166';
		break;
		
		case 5:
			return '#ad4733';
		break;	
	}
}
function categoria(categoria)
{ 	
	if(window.pagina == 'preguntas'){
		var operacion = 1;
		var id = '#centro #info';
		var id_provincia = 0;
	}
	else if(window.pagina == 'ranking'){
		var operacion = 18;
		var id = '#centro #ranking #ranking_grill';
		var id_provincia = $('#filtrar_por_provincia select option:selected').val();
		$('#categoria_val').val(categoria);
	}
	$.ajax({
		type: "POST",
		url: "operaciones.php",
		data: { 'operacion': operacion, 'categoria': categoria, 'id_provincia': id_provincia }
		}).done(function(msg) {
			$(id).html(msg);
			grilla(5,50,'ranking_grill');
			$('#centro #ranking #ranking_grill').css('border-color',color(categoria));
	});		
	window.categoria_color = categoria;	
}
function validar_respuesta(id_pregunta,i,id_usuario){
	id_categoria = $('input[name=categoria]').val();
	id_respuesta = $('input[name=respuesta'+ i +']:checked').val();
	if(id_respuesta){
		if(id_usuario != 0){
			respuesta(id_pregunta, id_respuesta, id_usuario, id_categoria);
		}
		else{
			window.location = 'registrar.php';
		}
	}
	else{
		alert('Seleccion\u00e1 una respuesta.');	
	}
}
function respuesta(id_pregunta,id_respuesta,id_usuario,id_categoria){
	$.ajax({
		type: "POST",
		url: "operaciones.php",
		data: { 'operacion': 3, 'id_pregunta': id_pregunta, 'id_respuesta': id_respuesta, 'user': id_usuario }
		}).done(function() {
			
			$.ajax({
				type: "POST",
				url: "operaciones.php",
				data: { 'operacion': 1, 'categoria': id_categoria, 'user': id_usuario }
				}).done(function(msg) {
					$('#info').html(msg);
			});	
		});
}
function set_localidades(){
	var id_provincia = $("#provincia").val();
	$.ajax({
		type: "POST",
		url: "operaciones.php",
		data: { 'operacion': 4, 'id_provincia': id_provincia }
		}).done(function(msg) {
			$('#form_registro #localidad').html(msg);
	});	
}

//COLORES DE LOS INPUT
var color_input = 'rgb(204, 204, 204)'; // #ccc
var color_over = 'rgb(170, 170, 170)'; // #aaa
var color_focus = 'rgb(134, 181, 211)'; //'#86b5d3'
var color_ok = 'rgb(140, 193, 117)'; //'#8cc175'
var color_error = 'rgb(189, 132, 128)'; //'#bd8480'
var ids = '#form_perfil input[type="text"], #form_perfil input[type="password"], #form_registro input[type="text"], #form_registro input[type="password"],select, #form_sugerir input[type="text"], #form_contacto input[type="text"], #form_recuperar_pass input[type="text"], textarea';

$(ids).focus(function(){
	$(this).css('border-color',color_focus);
	id = $(this).attr('id');
	$('#error_'+id).css('display','none');
});
$(ids).focusout(function(){
		$(this).css('border-color',color_input);
});
$(ids).mouseover(function(){
	color_border = $(this).css('border-left-color');
	if(color_border == color_input){
		$(this).css('border-color',color_over);
	}
});
$(ids).mouseout(function(){
	color_border = $(this).css('border-left-color');
	if(color_border == color_over){
		$(this).css('border-color',color_input);
	} 
});
//FIN COLORES DE LOS INPUT

//VALIDAR RECUPERAR PASS
function validar_recuperar_pass(){
	var email = $('#form_recuperar_pass #email').val();
	var result1 = validar_email(email);
	var error = 0;
	//VALIDO E-MAIL
	if(email != ""){
		if(result1 != 'ok'){
			$('#form_recuperar_pass #email').css('border-color','#bd7975');
			$('#form_recuperar_pass #error_email').html('El e-mail ingresado no es v\u00e1lido.');
			$('#form_recuperar_pass #error_email').fadeIn();
			error = 1;	
		}
		else{
			$.ajax({
				type: "POST",
				async: false,
				url: "operaciones.php",
				data: { 'operacion': 6, 'email': email }
				}).done(function(msg) {
					if(msg != 'repetido'){
						$('#form_recuperar_pass #email').css('border-color',color_error);
						$('#form_recuperar_pass #error_email').html('El e-mail ingresado no se encuentra registrado.');
						$('#form_recuperar_pass #error_email').fadeIn();
						error = 1;
					}
			});	
		}
	}
	else{
		$('#form_recuperar_pass #email').css('border-color',color_error);
		$('#form_recuperar_pass #error_email').html('Complet\u00e1 tu e-mail.');
		$('#form_recuperar_pass #error_email').fadeIn();
		error = 1;
	}
	if(error == 1){
		return false;
	}
}
//VALIDAR CONTACTO
function validar_contacto(){
	var nombre = $('#form_contacto #nombre').val();
	var email = $('#form_contacto #email').val();
	var asunto = $('#form_contacto #asunto').val();
	var mensaje = $('#form_contacto #mensaje').val();
	var result1 = validar_nombre(nombre);
	var result2 = validar_email(email);
	var error = 0;
	$('#form_contacto .error').html('');
	//VALIDO NOMBRE
	if(nombre != ""){
		if(result1 != 'ok'){
			$('#form_contacto #nombre').css('border-color',color_error);
			$('#form_contacto #error_nombre').html(result1);
			$('#form_contacto #error_nombre').fadeIn();
			error = 1;	
		}
		else{
			$('#form_contacto #error_nombre').css('display','none');
			$('#form_contacto #nombre').css('border-color',color_ok);
		}
	}
	else{
		$('#form_contacto #nombre').css('border-color',color_error);
		$('#form_contacto #error_nombre').html('Complet\u00e1 tu nombre.');
		$('#form_contacto #error_nombre').fadeIn();
		error = 1;
	}
	//VALIDO E-MAIL
	if(email != ""){
		if(result2 != 'ok'){
			$('#form_contacto #email').css('border-color','#bd7975');
			$('#form_contacto #error_email').html('El e-mail ingresado no es v\u00e1lido.');
			$('#form_contacto #error_email').fadeIn();
			error = 1;	
		}
		else{
			$('#form_contacto #error_email').css('display','none');
			$('#form_contacto #email').css('border-color',color_ok);	
		}
	}
	else{
		$('#form_contacto #email').css('border-color',color_error);
		$('#form_contacto #error_email').html('Complet\u00e1 tu e-mail.');
		$('#form_contacto #error_email').fadeIn();
		error = 1;
	}
	//VALIDO ASUNTO
	if(asunto == ""){
		$('#form_contacto #asunto').css('border-color',color_error);
		$('#form_contacto #error_asunto').html('Complet\u00e1 el asunto del mensaje.');
		$('#form_contacto #error_asunto').fadeIn();
		error = 1;
	}
	//VALIDO MENSAJE
	if(mensaje == ""){
		$('#form_contacto #mensaje').css('border-color',color_error);
		$('#form_contacto #error_mensaje').html('Complet\u00e1 el mensaje.');
		$('#form_contacto #error_mensaje').fadeIn();
		error = 1;
	}
	if(error == 1){
		return false;
	}
}

function validar_contacto_logged(){
	var asunto = $('#form_contacto #asunto').val();
	var mensaje = $('#form_contacto #mensaje').val();
	var error = 0;
	$('#form_contacto .error').html('');
	//VALIDO ASUNTO
	if(asunto == ""){
		$('#form_contacto #asunto').css('border-color',color_error);
		$('#form_contacto #error_asunto').html('Complet\u00e1 el asunto del mensaje.');
		$('#form_contacto #error_asunto').fadeIn();
		error = 1;
	}
	//VALIDO MENSAJE
	if(mensaje == ""){
		$('#form_contacto #mensaje').css('border-color',color_error);
		$('#form_contacto #error_mensaje').html('Complet\u00e1 el mensaje.');
		$('#form_contacto #error_mensaje').fadeIn();
		error = 1;
	}
	if(error == 1){
		return false;
	}
}
//FIN VALIDAR CONTACTO

//VALIDAR REGISTRAR
function validar_registrar(){
	var nick = $('#form_registro #nick').val();
	var pass = $('#form_registro #pass').val();
	var pass2 = $('#form_registro #pass2').val();
	var email = $('#form_registro #email').val();
	var nombre = $('#form_registro #nombre').val();
	var apellido = $('#form_registro #apellido').val();
	var nacimiento = $('#form_registro #nacimiento').val();
	var sexo = $('#form_registro #sexo').val();
	var dni = $('#form_registro #dni').val();
	var provincia = $('#form_registro #provincia').val();
	var localidad = $('#form_registro #localidad').val();
	var twitter = $('#form_registro #twitter').val();
	var telefono = $('#form_registro #telefono').val();
	var celular = $('#form_registro #celular').val();
	var terminos = $('#form_registro #terminos').val();
	var error = 0;
	$('#form_registro .error').html('');
	
	//VALIDO NICK
	if(nick != ""){
		if(nick.length < 4){
			$('#form_registro #nick').css('border-color',color_error);
			$('#form_registro #error_nick').html('Al menos 4 caracteres.');
			$('#form_registro #error_nick').fadeIn();
			error = 1;
		}
		else if(nick.length > 10){
			$('#form_registro #nick').css('border-color',color_error);
			$('#form_registro #error_nick').html('10 caracteres m\u00e1ximo.');
			$('#form_registro #error_nick').fadeIn();
			error = 1;
		}
		else{
			$.ajax({
				type: "POST",
				async: false,
				url: "operaciones.php",
				data: { 'operacion': 5, 'nick': nick }
				}).done(function(msg) {
					if(msg == 'repetido'){
						$('#form_registro #nick').css('border-color',color_error);
						$('#form_registro #error_nick').html('El nick '+nick+' no est\u00e1 disponible.');
						$('#form_registro #error_nick').fadeIn();
						error = 1;
					}
				});		
		}
	}
	else{
		$('#form_registro #nick').css('border-color',color_error);
		$('#form_registro #error_nick').html('Complet\u00e1 tu nick.');
		$('#form_registro #error_nick').fadeIn();
		error = 1;	
	}
	
	//VALIDO PASS
	if(pass != ""){
		if(pass.length < 8){
			$('#form_registro #error_pass2').css('display','none');
			$('#form_registro #pass').css('border-color',color_error);
			$('#form_registro #pass2').css('border-color','#ddd');
			$('#form_registro #error_pass').html('Al menos 8 caracteres.');
			$('#form_registro #error_pass').fadeIn();
			error = 1;
		}
		else if(pass != pass2){
			$('#form_registro #error_pass').css('display','none');
			$('#form_registro #pass').css('border-color',color_ok);
			$('#form_registro #pass2').css('border-color',color_error)
			$('#form_registro #error_pass2').html('Las contrase\u00f1as no coinciden.');
			$('#form_registro #error_pass2').fadeIn();
			error = 1;
		}
		else{
			$('#form_registro #error_pass').css('display','none');
			$('#form_registro #error_pass2').css('display','none');
			$('#form_registro #pass').css('border-color',color_ok);
			$('#form_registro #pass2').css('border-color',color_ok);
		}
	}
	else{
		$('#form_registro #pass').css('border-color',color_error);
		$('#form_registro #error_pass').html('Complet\u00e1 tu contrase\u00f1a.');
		$('#form_registro #error_pass').fadeIn();
		error = 1;
	}
	
	//VALIDO E-MAIL
	if(email != ''){
		var result = validar_email(email);
		if(result != 'ok'){
			$('#form_registro #email').css('border-color',color_error);
			$('#form_registro #error_email').html(result);
			$('#form_registro #error_email').fadeIn();
			error = 1;
		}
		else{
			$.ajax({
				type: "POST",
				async: false,
				url: "operaciones.php",
				data: { 'operacion': 6, 'email': email }
				}).done(function(msg) {
					if(msg == 'repetido'){
						$('#form_registro #email').css('border-color',color_error);
						$('#form_registro #error_email').html('El e-mail ingresado ya se encuentra registrado.');
						$('#form_registro #error_email').fadeIn();
						error = 1;
					}
			});	
		}
	}
	else
	{
		$('#form_registro #email').css('border-color',color_error);
		$('#form_registro #error_email').html('Complet\u00e1 tu e-mail.');
		$('#form_registro #error_email').fadeIn();
		error = 1;
	}
	
	//VALIDO NOMBRE
	if(nombre != ""){
		var result = validar_nombre(nombre);
		if(result != 'ok'){
			$('#form_registro #nombre').css('border-color',color_error);
			$('#form_registro #error_nombre').html(result5);
			$('#form_registro #error_nombre').fadeIn();
			error = 1;	
		}
		else{
			$('#form_registro #error_nombre').css('display','none');
			$('#form_registro #nombre').css('border-color',color_ok);
		}
	}
	else{
		$('#form_registro #nombre').css('border-color',color_error);
		$('#form_registro #error_nombre').html("Complet\u00e1 tu nombre.");
		$('#form_registro #error_nombre').fadeIn();
		error = 1;
	}
	
	//VALIDO APELLIDO
	if(apellido != ""){
		var result = validar_apellido(apellido);
		if(result != 'ok'){
			$('#form_registro #apellido').css('border-color',color_error);
			$('#form_registro #error_apellido').html(result6);
			$('#form_registro #error_apellido').fadeIn();
			error = 1;	
		}
		else{
			$('#form_registro #error_apellido').css('display','none');
			$('#form_registro #apellido').css('border-color',color_ok);
		}
	}
	else{
		$('#form_registro #apellido').css('border-color',color_error);
		$('#form_registro #error_apellido').html('Complet\u00e1 tu apellido.');
		$('#form_registro #error_apellido').fadeIn();
		error = 1;
	}
	
	//VALIDO NACIMIENTO
	if($('#form_registro #nacimiento').val() == $('#form_registro #hoy').val()){
		$('#form_registro #nacimiento').css('border-color',color_error);
		$('#form_registro #error_nacimiento').html('Complet\u00e1 tu fecha de nacimiento.');
		$('#form_registro #error_nacimiento').fadeIn();
		error = 1;
	}
	if($('#form_registro #sexo').val() == null){
		$('#form_registro #sexo').css('border-color',color_error);
		$('#form_registro #error_sexo').html('Seleccion\u00e1 tu sexo.');
		$('#form_registro #error_sexo').fadeIn();
		error = 1;
	}
	if($('#form_registro #provincia').val() == null){
		$('#form_registro #provincia').css('border-color',color_error);
		$('#form_registro #error_provincia').html('Seleccion\u00e1 tu provincia.');
		$('#form_registro #error_provincia').fadeIn();
		error = 1;
	}
	if(!$('#form_registro #terminos').is(':checked')){
		$('#form_registro #terminos').css('border-color',color_error);
		$('#form_registro #error_terminos').html('Para continuar debes leer y aceptar los t\u00e9rminos y condiciones.');
		$('#form_registro #error_terminos').fadeIn();
		error = 1;
	}
	
	//VALIDO DOCUMENTO
	if(dni != ""){
		var result = validar_documento(dni);
		if(result != 'ok'){
			$('#form_registro #dni').css('border-color',color_error);
			$('#form_registro #error_dni').html(result);
			$('#form_registro #error_dni').fadeIn();
			error = 1;	
		}
		else{
			$('#form_registro #error_dni').css('display','none');
			$('#form_registro #dni').css('border-color',color_ok);
		}
	}
	else{
		$('#form_registro #dni').css('border-color',color_error);
		$('#form_registro #error_dni').html('Complet\u00e1 tu n\u00famero de documento.');
		$('#form_registro #error_dni').fadeIn();
		error = 1;
	}
	
	//VALIDO TWITTER
	if(twitter != ""){
		var result = validar_twitter(twitter);
		if(result != 'ok'){
			$('#form_registro #twitter').css('border-color',color_error);
			$('#form_registro #error_twitter').html(result);
			$('#form_registro #error_twitter').fadeIn();
			error = 1;
		}
		else{
			$('#form_registro #error_twitter').css('display','none');
			$('#form_registro #twitter').css('border-color',color_ok);
		}
	}
	else{
		$('#form_registro #twitter').css('border-color',color_input);
	}
	
	//VALIDO TELEFONO
	if(telefono != ""){
		var result = validar_telefono(telefono);
		if(result != 'ok'){
			$('#form_registro #telefono').css('border-color',color_error);
			$('#form_registro #error_telefono').html(result);
			$('#form_registro #error_telefono').fadeIn();
			error = 1;	
		}
		else{
			$('#form_registro #error_telefono').css('display','none');
			$('#form_registro #telefono').css('border-color',color_ok);
		}
	}
	else{
		$('#form_registro #telefono').css('border-color',color_input);
	}
	
	//VALIDO CELULAR
	if(celular != ""){
		var result = validar_telefono(celular);
		if(result != 'ok'){
			$('#form_registro #celular').css('border-color',color_error);
			$('#form_registro #error_celular').html(result);
			$('#form_registro #error_celular').fadeIn();
			error = 1;	
		}
		else{
			$('#form_registro #error_celular').css('display','none');
			$('#form_registro #celular').css('border-color',color_ok);
		}
	}
	else{
		$('#form_registro #celular').css('border-color',color_input);
	}
	
	if(error == 1){
		return false;
	}					
}
//FIN VALIDAR REGISTRAR

//VALIDAR CAMBIOS PERFIL
function validar_perfil(){
	var pass = $('#form_perfil #pass').val();
	var pass2 = $('#form_perfil #pass2').val();
	var email = $('#form_perfil #email').val();
	var nombre = $('#form_perfil #nombre').val();
	var apellido = $('#form_perfil #apellido').val();
	var twitter = $('#form_perfil #twitter').val();
	var telefono = $('#form_perfil #telefono').val();
	var celular = $('#form_perfil #celular').val();
	var foto_usuario = $('#foto_usuario').val();
	var error = 0;
	$('#form_perfil .error').html('');
	var result2 = validar_twitter(twitter);
	var result3 = validar_telefono(celular);
	var result4 = validar_telefono(telefono);
	var result5 = validar_nombre(nombre);
	var result6 = validar_apellido(apellido);
	var result7 = validar_email(email);
	
	//VALIDO PASSWORD
	if(pass.length < 8){
		$('#form_perfil #error_pass2').css('display','none');
		$('#form_perfil #pass').css('border-color',color_error);
		$('#form_perfil #pass2').css('border-color','#ddd');
		$('#form_perfil #error_pass').html('Al menos 8 caracteres.');
		$('#form_perfil #error_pass').fadeIn();
		error = 1;
	}
	else if(pass != pass2){
		$('#form_perfil #error_pass').css('display','none');
		$('#form_perfil #pass').css('border-color',color_ok);
		$('#form_perfil #pass2').css('border-color',color_error)
		$('#form_perfil #error_pass2').html('Las contrase\u00f1as no coinciden.');
		$('#form_perfil #error_pass2').fadeIn();
		error = 1;
	}
	else{
		$('#form_perfil #error_pass').css('display','none');
		$('#form_perfil #error_pass2').css('display','none');
		$('#form_perfil #pass').css('border-color',color_ok);
		$('#form_perfil #pass2').css('border-color',color_ok);
	}
	
	//VALIDO NOMBRE
	if(nombre != ""){
		if(result5 != 'ok'){
			$('#form_perfil #nombre').css('border-color',color_error);
			$('#form_perfil #error_nombre').html(result5);
			$('#form_perfil #error_nombre').fadeIn();
			error = 1;	
		}
		else{
			$('#form_perfil #error_nombre').css('display','none');
			$('#form_perfil #nombre').css('border-color',color_ok);
		}
	}
	else{
		$('#form_perfil #nombre').css('border-color',color_error);
		$('#form_perfil #error_nombre').html("Complet\u00e1 tu nombre.");
		$('#form_perfil #error_nombre').fadeIn();
		error = 1;
	}
	
	//VALIDO APELLIDO
	if(apellido != ""){
		if(result6 != 'ok'){
			$('#form_perfil #apellido').css('border-color',color_error);
			$('#form_perfil #error_apellido').html(result6);
			$('#form_perfil #error_apellido').fadeIn();
			error = 1;	
		}
		else{
			$('#form_perfil #error_apellido').css('display','none');
			$('#form_perfil #apellido').css('border-color',color_ok);
		}
	}
	else{
		$('#form_perfil #apellido').css('border-color',color_error);
		$('#form_perfil #error_apellido').html('Complet\u00e1 tu apellido.');
		$('#form_perfil #error_apellido').fadeIn();
		error = 1;
	}
	//VALIDO E-MAIL
	if(email != ""){
		if(result7 != 'ok'){
			$('#form_perfil #email').css('border-color','#bd7975');
			$('#form_perfil #error_email').html('El e-mail ingresado no es v\u00e1lido.');
			$('#form_perfil #error_email').fadeIn();
			error = 1;	
		}
		else{
			$.ajax({
				type: "POST",
				async: false,
				url: "operaciones.php",
				data: { 'operacion': 6, 'email': email }
				}).done(function(msg) {
					if(msg == 'repetido'){
						$('#form_perfil #email').css('border-color',color_error);
						$('#form_perfil #error_email').html('Este e-mail ya se encuentra registrado.');
						$('#form_perfil #error_email').fadeIn();
						error = 1;	
					}
					else{
						$('#form_perfil #error_email').css('display','none');
						$('#form_perfil #email').css('border-color',color_ok);
					}
			});	
		}
	}
	else{
		$('#form_perfil #email').css('border-color',color_error);
		$('#form_perfil #error_email').html('Complet\u00e1 tu e-mail.');
		$('#form_perfil #error_email').fadeIn();
		error = 1;
	}
	
	//VALIDO TWITTER
	if(twitter != ""){
		if(result2 != 'ok'){
			$('#form_perfil #twitter').css('border-color',color_error);
			$('#form_perfil #error_twitter').html(result2);
			$('#form_perfil #error_twitter').fadeIn();
			error = 1;
		}
		else{
			$('#form_perfil #error_twitter').css('display','none');
			$('#form_perfil #twitter').css('border-color',color_ok);
		}
	}
	else{
		$('#form_perfil #twitter').css('border-color',color_input);
	}
	
	//VALIDO TELEFONO
	if(telefono != ""){
		if(result4 != 'ok'){
			$('#form_perfil #telefono').css('border-color',color_error);
			$('#form_perfil #error_telefono').html(result4);
			$('#form_perfil #error_telefono').fadeIn();
			error = 1;	
		}
		else{
			$('#form_perfil #error_telefono').css('display','none');
			$('#form_perfil #telefono').css('border-color',color_ok);
		}
	}
	else{
		$('#form_perfil #telefono').css('border-color',color_input);
	}
	
	//VALIDO CELULAR
	if(celular != ""){
		if(result3 != 'ok'){
			$('#form_perfil #celular').css('border-color',color_error);
			$('#form_perfil #error_celular').html(result3);
			$('#form_perfil #error_celular').fadeIn();
			error = 1;	
		}
		else{
			$('#form_perfil #error_celular').css('display','none');
			$('#form_perfil #celular').css('border-color',color_ok);
		}
	}
	else{
		$('#form_perfil #celular').css('border-color',color_input);
	}
	if(error == 0){
		$.ajax({
			type: "POST",
			url: "operaciones.php",
			data: { 'operacion': 17, 'nombre': nombre, 'apellido': apellido, 'telefono': telefono, 'pass': pass, 'email': email, 'twitter': twitter, 'celular':celular, 'foto_usuario': foto_usuario }
			}).done(function() {
				alert('Los datos fueron modificados con \u00e9xito');
				window.location = 'perfil.php';
		});	
	}
}
//FIN VALIDAR CAMBIOS PERFIL

//VALIDAR SUGERIR PREGUNTA
function validar_sugerir(){
	var categoria = $('#form_sugerir select option:selected').val();
	var texto = $('#form_sugerir #pregunta').val();
	if(categoria == 0){
		alert('Eleg\u00ed una categor\u00eda.');
		return false;	
	}
	if(texto == ''){
		alert('Escrib\u00ed una pregunta.');
		return false;
	}
	alert('La pregunta ha sido enviada con \u00e9xito.\nGracias por tu sugerencia.');
	$('#form_sugerir #pregunta').val('');
	$('#form_sugerir select option[value=0]').attr('selected',true);
}

//ARMA LAS GRILLAS DE TORNEOS
function grilla(columnas, filas, id){
	var ancho_columnas = new Array();;
	for(i=0;i<columnas;i++){
		ancho = 0;	
		for(j=0;j<filas;j++){
			var x = $('#'+id+' ul:eq('+j+') li:eq('+i+')').width();
			if(ancho == 0){
				ancho = x;
			}
			else if(ancho < x)
			{
				ancho = x;
			}
		}
		ancho_columnas[i] = ancho;
		for(j=0;j<filas;j++){
			$('#'+id+' ul:eq('+j+') li:eq('+i+')').css('width',ancho_columnas[i]+'px');
		}
	}	
}
function mostrar_torneos(var_1, var_2, opcion){
	switch(opcion){
		case 1:
			$.ajax({
				type: "POST",
				url: "operaciones.php",
				data: { 'operacion': 8, 'inicio': var_1, 'registros': var_2 }
				}).done(function(msg) {
					$('#torneos #contenido').html(msg);
					$('#btn_banda #buscar_torneo').addClass('seleccionado');
					$('#btn_banda #crear_torneo').removeClass('seleccionado');
					grilla(5,11,'torneos_grill');
			});
		break;
		case 2:
			$.ajax({
				type: "POST",
				url: "operaciones.php",
				data: { 'operacion': 9, 'id_torneo': var_1, 'user': var_2}
				}).done(function(msg) {
					$('#torneos #contenido').html(msg);
					$('#btn_banda #buscar_torneo').removeClass('seleccionado');
					$('#btn_banda #crear_torneo').removeClass('seleccionado');
					var tot_usuarios_torneo = $('#tot_usuarios_torneo').val();
					grilla(5,tot_usuarios_torneo,'info_torneo');
			});
		break
		case 3:
			$.ajax({
				type: "POST",
				url: "operaciones.php",
				data: { 'operacion': 10, 'id_torneo': var_1, 'user': var_2}
				}).done(function(msg) {
					$('#torneos #contenido').html(msg);
					$('#btn_banda #crear_torneo').addClass('seleccionado');
					$('#btn_banda #buscar_torneo').removeClass('seleccionado');
			});
			$('#btn_banda #crear_torneo').addClass('seleccionado');
			$('#btn_banda #buscar_torneo').removeClass('seleccionado');
		break;
	};		
}
function torneo_anotar(id_usuario, id_torneo){
	$.ajax({
		type: "POST",
		url: "operaciones.php",
		data: { 'operacion': 11, 'id_torneo': id_torneo}
		}).done(function(msg) {
			$('ul .jugar #torneo_'+id_torneo+'').attr('onclick','');
			$('ul .jugar #torneo_'+id_torneo+'').css('color','#ccc');
			$('#torneos_pendiente').html(msg);
	});
}
function crear_torneo(){
	var nombre_torneo = $('#torneo_input').val();
	var nombre_length = nombre_torneo.length;
	if(nombre_length > 3){
		if(nombre_length < 26){
			$.ajax({
				type: "POST",
				url: "operaciones.php",
				data: { 'operacion': 12, 'nombre_torneo': nombre_torneo }
				}).done(function(msg) {
					var torneo_existe = $('#torneo_existe').val();
					if(msg == 'El torneo fue creado.'){
						$('#buscar_torneo span').css('color','#e0edf4');
						$('#buscar_torneo span').html(msg);
						$('#torneo_input').val("");
						$.ajax({
							type: "POST",
							url: "operaciones.php",
							data: { 'operacion': 14, 'estado_torneo': 1 }
							}).done(function(msg){
									$('#torneos_usuario').html(msg);
									$('#buscar_torneo #torneo_input').html('');
						});
					}
					else{
						$('#buscar_torneo span').css('color','#e6281c');
						$('#buscar_torneo span').html(msg);
					}
					
			});
		}
		else{
			$('#buscar_torneo span').css('color','#e6281c');
			$('#buscar_torneo span').html('M\u00e1ximo 25 caracteres.');
		}
	}
	else{
		$('#buscar_torneo span').css('color','#e6281c');
		$('#buscar_torneo span').html('M\u00ednimo 4 carateres.');
	}
}
function buscar_torneos(){
	var busqueda = $('#torneo_input').val();
	var busqueda_length = busqueda.length;
	if(busqueda_length > 2){
		$.ajax({
			type: "POST",
			url: "operaciones.php",
			data: { 'operacion': 8, 'inicio': 0, 'registros':10, 'busqueda': busqueda }
			}).done(function(msg) {
				$('#torneos #contenido').html(msg);
				grilla(5,11,'torneos_grill');
		});
	}
	else{
		$('#buscar_torneo span').css('color','#e6281c');
		$('#buscar_torneo span').html('M\u00ednimo 3 carateres.');
	}
	
}
function abandonar_torneo(id_torneo, estado){
	$.ajax({
		type: "POST",
		url: "operaciones.php",
		data: { 'operacion': 13, 'id_torneo': id_torneo }
		}).done(function() {
			$.ajax({
				type: "POST",
				url: "operaciones.php",
				data: { 'operacion': 14, 'estado_torneo': estado }
				}).done(function(msg){
					if(estado == 0){
						$('#torneos_pendiente').html(msg);
					}
					else{
						$('#torneos_usuario').html(msg);
					}
					if($('#estamos_en_busqueda').val() == 1){
						mostrar_torneos(0, 10, 1);
					}
			});
	});
}
function confirmar_usuario_torneo(id_usuario, id_torneo){
	$.ajax({
		type: "POST",
		url: "operaciones.php",
		data: { 'operacion': 15, 'id_usuario': id_usuario, 'id_torneo': id_torneo }
		}).done(function() {
			mostrar_torneos(id_torneo, 0, 2)
	});
}
function eliminar_usuario_torneo(id_usuario, id_torneo){
	$.ajax({
		type: "POST",
		url: "operaciones.php",
		data: { 'operacion': 16, 'id_usuario': id_usuario, 'id_torneo': id_torneo }
		}).done(function() {
			mostrar_torneos(id_torneo, 0, 2)
	});
}

//FUNCIONES PARA VALIDAR
function validar_twitter(twitter){
	var regex = /^@([A-Za-z0-9_]+)$/;		
	if(!regex.test(twitter) && twitter != ''){
		return 'El usuario de twitter debe ingresar con @';
	}
	else{
		return 'ok';	
	}
}
function validar_telefono(numero){
	var regex = /^([0-9]{8,15})$/;
	if(!regex.test(numero) && numero != ''){
		return 'El tel\u00e9fono ingresado no es v\u00e1lido.';
	}
	else{
		return 'ok';
	}
}
function validar_documento(numero){
	var regex = /^([0-9]{7,8})$/;
	if(!regex.test(numero) && numero != ''){
		return 'El documento ingresado no es v\u00e1lido.';
	}
	else{
		return 'ok';
	}
}
function validar_nombre(nombre){
	var regex = /^([a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+)$/;
	if(!regex.test(nombre) && nombre != ''){
		return 'El nombre ingresado no es v\u00e1lido.';
	}
	else{
		return 'ok';
	}
}
function validar_apellido(apellido){
	var regex = /^([a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+)$/;
	if(!regex.test(apellido) && apellido != ''){
		return 'El apellido ingresado no es v\u00e1lido.';
	}
	else{
		return 'ok';
	}
}
function validar_email(email){
	var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
							
	if(!regex.test(email)){
		return'El e-mail ingresado no es v\u00e1lido.';
	}
	else{
		return 'ok';
	}	
}