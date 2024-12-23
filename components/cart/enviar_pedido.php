<?php

include_once '../../includes/user-validation.php';

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
    
    $headers = "From: ".$email."\r\n";  // Remitente (tu correo)

    
    echo $message . $to . $subject . $headers;
    
    if(mail($to, $subject, $message, $headers)) {
        echo "Correo enviado con éxito.";
    } else {
        echo "Error al enviar el correo.";
    }
}

?>    