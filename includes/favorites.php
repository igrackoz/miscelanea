<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'dbconnect.php';
    
    // Ajusta la consulta para omitir `favorite_id` si es AUTO_INCREMENT
    $query = "INSERT INTO favorites (user_id, product_id) VALUES (?, ?)";
    $stmt = $Conn->prepare($query);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $Conn->error);
    }
    
    $stmt->bind_param('ii', $_POST['userId'], $_POST['productId']);
    if (!$stmt->execute()) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }
    
    $stmt->close();
    $Conn->close();
}
