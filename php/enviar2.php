<?php

// 1 - INSTANCIAMOS RECURSOS Y CLASES
// REQUERIMOS DOS ARCHIVOS PHP (uso de clases y objetos)
require_once "./includes/_config.php";
require_once "./class/_comprobaciones.php";
//Instanciamos un objeto de clase "clase_comprobaciones"
$comprobacion = new clase_comprobaciones;



if(isset($_POST)){
    /* 1. Recoger datos y comprobar */
    $destino = "leireariceta@gmail.com"; /* CORREO DEL ADMIN */
    $nombre = $_POST ["nombre"]; /* Nombre del usuario */
    $correo = $_POST ["correo"];
    $telefono = $_POST ["telefono"];
    $mensaje = $_POST ["mensaje"];

     // comprobamos que el nombre no venga vacío
     if($comprobacion->comprobarVacio($nombre)){    
        header("location:../index.html?fallo=1#hitoContacto");
        die; //salimos de este PHP aquí, sin ejecutar el resto de líneas posteriores.
    }

     // limpiamos de cualquier caracter usado en scripts maliciosos
     $comprobacion->filtrarValorLight($nombre);

    // VALIDACIONES DE CORREO
    // comprobamos que el correo no venga vacío
    if($comprobacion->comprobarVacio($correo)){    
        header("location:../index.html?fallo=2#hitoContacto");
        die;
    }
    // limpiamos de cualquier caracter usado en scripts maliciosos
    $comprobacion->filtrarValorLight($correo);
    // comprobamos que el correo sea un correo
    // llamamos a la función de la clase comprobaciones
    if(!$comprobacion->validar_email($correo)){    
        header("location:../index.html?fallo=3#hitoContacto");
        die;
    }

    // VALIDACIONES DE TELÉFONO
    // comprobamos que el teléfono no venga vacío
    if($comprobacion->comprobarVacio($telefono)){    
        header("location:../index.html?fallo=4#hitoContacto");
        die;
    }
        // limpiamos de cualquier caracter usado en scripts maliciosos y quitamos espacios al número
        $comprobacion->filtrarValor($telefono);
        // comprobamos si es número
    if(!$comprobacion->validar_numero($telefono)){
            header("location:../index.html?fallo=5#hitoContacto");
            die;
    }

    // COMPROBACIONES MENSAJE
    // comprobamos que el nombre no venga vacío
    if($comprobacion->comprobarVacio($mensaje)){    
        header("location:../index.html?fallo=6#hitoContacto");
        die;
    }
    // limpiamos de cualquier caracter usado en scripts maliciosos
    $comprobacion->filtrarValorLight($mensaje); 
    
    


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