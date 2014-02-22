<?php
	require_once('cnx.php');
	require_once('funciones.php');
	require_once('seguridad.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yo s&eacute; m&aacute;s que vos</title>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="css/estilos.css" />
</head>
<body>
<div id="contenido">
	<header id="header">
    	<?php include('inc/header.php'); ?>
    </header>
    <div id="banda">
		<?php include('inc/banda.php'); ?>
    </div>
    <div id="centro">
    	<section id="reglamento">
            <div style="font-size:16px;padding-bottom:20px;font-weight:bold;">Reglamento</div>
            <div id="texto">
                <p><b>1. Objetivo del juego</b><br/>
        Sumar la mayor cantidad de puntos respondiendo preguntas acerca de eventos a suceder en el futuro.
                </p><br/>
                <p><b>2. Desarrollo</b><br/>
                Los participantes deberán responder preguntas que irán apareciendo en el sitio web. Todas las preguntas son de respuestas de opciones múltiples. Cada pregunta tendrá entre dos y ocho posibles respuestas.<br/>
                Una vez respondida cada pregunta, no podrá ser modificada.<br/>
                Todas las preguntas tienen una fecha de caducidad. Una vez pasada esa fecha, no se podrá responder esa pregunta.
                </p><br/>
                <p><b>3. Asignación de puntos</b><br/>
                Cada pregunta tendrá un valor de puntos asignados por el juego. El valor puede ser desde 1 hasta 500 puntos. <br/>
                Las preguntas serán divididas en cuatro categorías. El valor total de las preguntas durante el periodo de un mes será de 2000 puntos, a razón de 500 puntos por categoría.
                </p><br/>
                <p><b>4. ¿Cómo participar?</b><br/>
                Para participar del Juego deben llenarse los datos que se solicitan en el Sitio Web y aceptando los términos y condiciones.<br/>
                Los Participantes deberán cumplir con todo lo dispuesto en el reglamento, en los términos y condiciones y sus eventuales modificaciones durante toda la vigencia del Juego. Caso contrario, podrá ser dado de baja del Juego, no pudiendo reclamar ningún rubro en concepto de indemnización a la organización o auspiciantes del juego.<br/>
                Cualquier persona con residencia en la República Argentina podrá participar. Solo podrán ganar premios los participantes mayores de 18 años.
                </p><br/>
                <p><b>4.1. Falsedad de la información registrada</b><br/>
                En caso de que Yosemasquevos verifique que la información registrada por un participante es falsa y/o presuma razonablemente que la misma ha sido falsificada, podrá a su exclusivo criterio, y sin derecho a reclamo alguno por parte de ningún participante del juego, cancelar el registro y la inscripción correspondiente.<br/>
                En caso que el participante cuya información haya sido cuestionada hubiere resultado presuntamente ganador de una fecha y/o el premio del juego, quedará a criterio exclusivo de Yosemaquevos la entrega o no del premio correspondiente justificando su decisión en cada circunstancia, renunciando dicho participante y el resto de los participantes del juego, a reclamar por cualquier vía dicha decisión.<br/>
                Será también pasible de cancelación de su inscripción y la consecuente baja del Juego, todo participante que no cumpla con las reglas del presente Reglamento, cualquiera sea su gravedad, sin que ello le otorgue derecho a reclamo alguno contra el organizado y/o auspiciante).<br/>
                Cada participante podrá participar con un único nombre de usuario. Para poder ser acreedor de los premios, el participante deberá constatar su DNI con el número que ingresó al momento de suscribirse. En caso de haber utilizado un número ajeno, no podrá obtener su premio y será ganador el siguiente participante con mayor cantidad de puntos.
                </p><br/>
                <p><b>4.2. Confidencialidad de uso de datos personales</b><br/>
                Todos los datos completados en la ficha de registración serán tratados con estricta confidencialidad. Yosemasquevos garantiza que no cederá los datos personales a terceros.<br/>
                Todo participante que autorice a Yosemasquevos a recibir información acerca de terceros deberá expresarlo en el Sitio Web, seleccionando la opción adecuada en la ficha de registración. El participante podrá dejar de recibir dicha información seleccionando la opción adecuada en el Sitio Web.
                </p><br/>
                <p><b>5. Premios</b><br/>
                Los premios correspondientes al Campeón del Mes, Año o cualquier otro premio adicional que puediera surgir serán definidos y comunicados por Yosemasquevos.
                En caso que el ganador no haya podido ser localizado en 90 días, no podrá ser acreedor del premio ni realizar reclamo alguno.<br/>
                Yosemasquevos se reserva el derecho de modificar o eliminar premios sin previo aviso.<br/>
                </p><br/>
                <p><b>6. Empates</b><br/>
                En caso de empate entre dos o más participantes, se recurrirá respetando el orden de prelación a los siguientes mecanismos de desempate:<br/>
                1.	Participante con mayor cantidad de preguntas acertadas durante el periodo.<br/>
                2.	Mayor porcentaje de preguntas acertadas durante el periodo.<br/>
                3.	Participante con mayor cantidad de preguntas acertadas en la categoría: Política & Economía<br/>
                4.	Participante con mayor cantidad de puntos en la categoría: Política & Economía<br/>
                5.	Participante con mayor cantidad de preguntas acertadas en la categoría: Deportes<br/>
                6.	Participante con mayor cantidad de puntos en la categoría: Deportes<br/>
                7.	Participante con mayor cantidad de preguntas acertadas en la categoría: Espectáculos<br/>
                8.	Participante con mayor cantidad de puntos en la categoría: Espectáculos<br/>
                9.	Participante con mayor cantidad de preguntas acertadas en la categoría: Misceláneas<br/>
                10.	Participante con mayor cantidad de puntos en la categoría: Misceláneas<br/>
                11.	Quien tenga el menor número de orden de inscripción.<br/>
                </p><br/>
               <p><b>7. Comunicación a los ganadores</b><br/>
                Los nombres de los participantes ganadores de las diferentes rondas de Yosemasquevos se publicarán en el sitio web.
                </p><br/>
                <p><b>8.</b> Yosemasquevos se reserva el derecho de aplicar sanciones dentro del juego, como la quita de puntos, y/ o rechazar la participación de cualquier participante que no reúna las condiciones establecidas en el Reglamento o contravenga el espíritu del juego.
                </p><br/>
                <p><b>9.</b> Yosemasquevos no se responsabiliza por las posibles pérdidas, deterioros, robo de información, retrasos o cualquier otra circunstancia que pudiera perjudicar a los participantes del juego, como consecuencia de su participación.<br/>
                Los participantes deben dar cumplimiento a las pautas establecidas en el presente reglamento para el desarrollo del juego.<br/>
                Yosemasquevos no se responsabiliza por cualquier daño, directo, indirecto, inmediato, remoto que sufra un participante como consecuencia de su participación en el juego como así también los participantes renuncian a reclamar pérdidas de chances y/o circunstancias similares en virtud de las modificaciones, cancelaciones y/o demás circunstancias que pudieran ser propias y/o ajenas a Yosemasquevos.<br/>
                Yosemasquevos no será responsable de la circunstancia de que eventualmente el Sitio Web no esté disponible, por factores ajenos a la empresa.<br/> 
                Yosemasquevos no se hace responsable de los problemas o el mal funcionamiento técnico de líneas o redes telefónicas, sistemas de ordenadores en red, servidores o proveedores de acceso a Internet, equipos informáticos o software, ni del retraso o la no recepción de mensajes electrónicos o solicitudes de inscripción a raíz de problemas técnicos o de congestión del tráfico en Internet, en las líneas telefónicas o en el sitio web o de cualquier combinación de dichos contratiempos, incluidos los eventuales daños ocasionados al sistema informático o teléfono móvil del participante o de cualquier tercero, a resultas de la participación en el juego o de la descarga de cualquier material relacionado al juego.<br/>
                Yosemasquevos no se responsabiliza por el uso que pueda hacerse de la información provista por cada Participante en el supuesto que la misma sea utilizada sin autorización del Yosemasquevos.<br/>
                El Yosemasquevos no será responsable por cambios en la fecha de los eventos. <br/>
                </p><br/>
                <p><b>10.</b> Todos los participantes del juego autorizan a Yosemasquevos (y sus auspiciantes) a publicar y difundir sus datos personales y foto personal por cualquier formato y sin limitación de ningún tipo.
                </p><br/>
                <p><b>11.</b> El Yosemasquevos se reserva el derecho de modificar el presente reglamento y de cancelar total o parcialmente el juego durante su desarrollo, sin que ello otorgue derecho alguno a los participantes a reclamar ningún daño y/o perjuicio en virtud de dicha modificación y/o cancelación del juego.
                </p><br/>
                <p><b>12.</b> La participación en el juego supone la aceptación tácita del presente reglamento y los términos y condiciones.
                </p><br/>
            </div>
        </section>
    </div>
    <footer id="footer">
    	<?php include('inc/footer.php'); ?>
    </footer>
</div>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript">
</script>
</body>
</html>