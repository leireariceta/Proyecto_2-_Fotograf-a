<?php

// 1 - INSTANCIAMOS RECURSOS Y CLASES
// REQUERIMOS DOS ARCHIVOS PHP (uso de clases y objetos)
require_once "./includes/_config.php";
require_once "./class/_comprobaciones.php";
//Instanciamos un objeto de clase "clase_comprobaciones"
$comprobacion = new clase_comprobaciones;


//2 - COMPROBAMOS QUE VENGAMOS POR $_POST
// Hacemos una condición para ver si existe $_POST
if(isset($_POST)){

//3 - RECOGEMOS EN VARIABLES LOS VALORES DE LOS INPUT DEL FORM
 $destino = "aranaz@gmail.com";  //correo del admin
 $nombre = $_POST["nombre"]; //datos del usuario
 $correo = $_POST["correo"];
 $telefono = $_POST["telefono"];
 $mensaje = $_POST["mensaje"];


//4 - COMPROBAMOS LOS VALORES RECOGIDOS PARA EVITAR MALICIOSOS O ERRORES
    // VALIDACIONES DE NOMBRE
    // comprobamos que el nombre no venga vacío
    if($comprobacion->comprobarVacio($nombre)){    
        header("location:./../index.html?fallo=1#hitoContacto");
        die; //salimos de este PHP aquí, sin ejecutar el resto de líneas posteriores.
    }
    // limpiamos de cualquier caracter usado en scripts maliciosos
    $comprobacion->filtrarValorLight($nombre);
    // clase_comprobaciones::filtrarValor($nombre);//Esta forma de llamar es si la función es estática. Al ser estática no hace falta instanciarla en un objeto. La función debe ser public static function.


    // VALIDACIONES DE CORREO
    // comprobamos que el correo no venga vacío
    if($comprobacion->comprobarVacio($correo)){    
        header("location:./../index.html?fallo=2#hitoContacto");
        die;
    }
    // limpiamos de cualquier caracter usado en scripts maliciosos
    $comprobacion->filtrarValorLight($correo);
    // comprobamos que el correo sea un correo
    // llamamos a la función de la clase comprobaciones
    if(!$comprobacion->validar_email($correo)){    
        header("location:./../index.html?fallo=3#hitoContacto");
        die;
    }

    // VALIDACIONES DE TELÉFONO
    // comprobamos que el teléfono no venga vacío
    if($comprobacion->comprobarVacio($telefono)){    
        header("location:./../index.html?fallo=4#hitoContacto");
        die;
    }
    // limpiamos de cualquier caracter usado en scripts maliciosos y quitamos espacios al número
    $comprobacion->filtrarValor($telefono);
    // comprobamos si es número
   if(!$comprobacion->validar_numero($telefono)){
        header("location:./../index.html?fallo=5#hitoContacto");
        die;
   }

    // COMPROBACIONES MENSAJE
    // VALIDACIONES DE NOMBRE
    // comprobamos que el nombre no venga vacío
    if($comprobacion->comprobarVacio($mensaje)){    
        header("location:./../index.html?fallo=6#hitoContacto");
        die;
    }
    // limpiamos de cualquier caracter usado en scripts maliciosos
    $comprobacion->filtrarValorLight($mensaje);
    
    // fin de comprobaciones en PHP----------


//5 - RECOGEMOS OTROS VALORES DEL CLIENTE
    // ip
    $ip = $_SERVER['REMOTE_ADDR'];
    // fecha
    $datetime = date("Y-m-d H:i:s");


//6 - PREPARAMOS EL CONTENIDO DEL CORREO CON LOS VALORES YA FILTRADOS
    // mensaje concatenado para enviar por correo
    $contenido = "Fecha de envío: ".$datetime."\nIP: ".$ip."\nNombre: ".$nombre."\nCorreo: ".$correo."\nTeléfono: ".$telefono."\nMensaje: ".$mensaje;


//7  - PREPARAMOS CABECERA PARA EL CORREO (IMPORTANTE SI NO ES VÍA SMTP)
    $cabecera = 'From: info@webda.eus'."\r\n".
    'Reply-To: info@webda.eus'."\r\n".
    'X-Mailer: PHP/'.phpversion();


//8 - ENVIAMOS CORREOS POR PHPMAILER
    //rellenamos algunas variables que se usarán en _phpmailer.php
    
    $correoEmisor = "info@webda.eus";
    $nombreEmisor = "Webda - Alumno";
    $destinatario = $correo;
    $nombreDestinatario = $nombre;
    $asunto = "Consulta realizada en la web";
    $cuerpo = $contenido;

    include "./includes/_phpmailer.php";


//9 - SALIMOS REDIRIGIENDO A OTRA PÁGINA, O A LA MISMA
    header("location:./../index.html?enviado=correo enviado!");


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