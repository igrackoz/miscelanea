<?php
/*
require_once '../../vendor2/vendor/autoload.php';

if (isset($_GET['products']) && isset($_GET['payment']) && isset($_GET['user'])) {
    $products = explode(",", urldecode($_GET['products']));
    $payment = explode(",", urldecode($_GET['payment']));
    $user = explode(",", urldecode($_GET['user']));

    // Ahora puedes usar el arreglo $items en PHP
    $productList = "<h2>Productos</h2><ul style='list-style-type: none; padding: 0;'>";
    foreach ($products as $product) {
        $productList .= "<li style='background-color: #f4f4f4; padding: 8px; margin: 5px 0; border-radius: 5px;'>$product</li>";
    }
    $productList .= "</ul>";
    
    // Construcción de la lista de métodos de pago
    $paymentList = "<h2>Métodos de Pago</h2><ul style='list-style-type: none; padding: 0;'>";
    foreach ($payment as $pay) {
        $paymentList .= "<li style='background-color: #e0e0e0; padding: 8px; margin: 5px 0; border-radius: 5px;'>$pay</li>";
    }
    $paymentList .= "</ul>";
    
    // Construcción de la lista de información del usuario
    $userInfo = "<h2>Información del Usuario</h2><ul style='list-style-type: none; padding: 0;'>";
    foreach ($user as $usr) {
        $userInfo .= "<li style='background-color: #f4f4f4; padding: 8px; margin: 5px 0; border-radius: 5px;'>$usr</li>";
    }
    $userInfo .= "</ul>";
    
    // Concatenar todo el contenido para el cuerpo del correo

    
    $message = $productList . $paymentList . $userInfo;

    $to = "igrackoz@outlook.com";  // Dirección de correo destino
    $subject = "pedido #001";  // Asunto del correo


    // Asunto del correo
    $subject = "Notificación de inserción en la base de datos";
    
    // Cabeceras
    $headers = "From: webmaster@tudominio.com";  // Cambia esto por tu correo de remitente
    
    // Enviar el correo
    if (mail($to, $subject, $message, $headers)) {
        echo "Correo enviado exitosamente.";
    } else {
        echo "Error al enviar el correo.";
    }
}*/

?>    

<?php

include_once '../../includes/user-validation.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';
require_once '../../vendor2/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.miscelanea-ana.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'envios@miscelanea-ana.com';                     //SMTP username
    $mail->Password   = 'Ribbonella16$';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('envios@miscelanea-ana.com', 'Mailer');
    $mail->addAddress('igrackoz@gmail.com', 'Joe User');     //Add a recipient
    $mail->addReplyTo('envios@miscelanea-ana.com', 'Information');
/*
    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
*/
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>    
