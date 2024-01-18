<?php
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require '../../../vendor/autoload.php';
  
$mail = new PHPMailer(true);
  
try {
    $mail->SMTPDebug = 0;                                       
    $mail->isSMTP();
    $mail->Host='webda-eus.correoseguro.dinaserver.com';                 
    $mail->SMTPAuth   = true;                        
    $mail->Username = 'info@webda.eus';                 
    $mail->Password = 'Areafor@02';                        
    $mail->SMTPSecure = 'ssl';                              
    $mail->Port = 465;  
  
    $email = $correoEmisor; //ok
    $mail->setFrom($email, $nombreEmisor); //ok
    $mail->addAddress($destinatario, $nombreDestinatario); //ok
    /* $mail->addCC('info@webda.eus');//copia
    $mail->addBCC('info@webda.eus');//copia oculta */
       
    $mail->isHTML(true);
    $mail->CharSet = PHPMailer::CHARSET_UTF8;                    
    $mail->Subject = $asunto; //ok
    $mail->Body = $cuerpo;
   /*  $mail->AddEmbeddedImage('../imags-web/mundo2.png', 'reflogotipo'); */
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        //echo $aviso; //SACAMOS AVISO EN LA WEB DEL ENVÍO DEL CORREO
    }
    
} catch (Exception $e) {
    echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
}
  
?>