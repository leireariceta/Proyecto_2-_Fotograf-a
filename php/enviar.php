<?php

if(isset($_POST)){
    /* 1. Recoger datos y comprobar */
    $destino = "leireariceta@gmail.com"; /* CORREO DEL ADMIN */
    $nombre = $_POST ["nombre"]; /* Nombre del usuario */
    $correo = $_POST ["correo"];
    $telefono = $_POST ["telefono"];
    $mensaje = $_POST ["mensaje"];


    /* datos que cogemos de tu cliente */
    /* IP */
    $ip=$_SERVER['REMOTE_ADDR'];

    /* Datos que cogemos del sistema */
    /* Fecha */
    $datetime= date("Y-m-d H:i:s");

    /* Mensaje concatenado para enviar por correo */
    $contenido = "fecha de envio: ".$datetime."\nIP: ".$ip."\nNombre: ".$nombre."\nCorreo: ".$correo."\nTeléfono: ".$telefono."\nMensaje: ".$mensaje;

    $cabecera = 'From: info@webda.eus'."\r\n".'Reply-To:  info@webda.eus'."\r\n".'X-Mailer: PHP/'.phpversion();

    /* Enviar correo de confirmación */
    mail($destino, "Consulta la web", $contenido,$cabecera);/* Correo que recibo yo */

    mail($correo, "Hemos recibido tu consulta",$contenido,$cabecera);

    /* Redirigir a index.html y salir de aquí */
    header("location:../index.html?enviado=correo enviado");
}
?>