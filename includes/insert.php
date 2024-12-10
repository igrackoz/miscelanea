<?php

// Función para cargar el archivo .env
function loadEnv($file)
{
    if (file_exists($file)) {
        $variables = parse_ini_file($file);
        foreach ($variables as $key => $value) {
            putenv("$key=$value");
        }
    }
}

// Cargar las variables de entorno desde el archivo .env
loadEnv(__DIR__ . '/.env');

// Recuperar las variables de entorno
$servername = getenv('DB_SERVER');
$usr = getenv('DB_USER');
$pwd = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

try {
    // Conectar a la base de datos
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $usr, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Leer los datos enviados desde JavaScript
    $input = json_decode(file_get_contents('php://input'), true);

    // Validar que se hayan recibido los datos necesarios
    if (isset($input['quantity']) && isset($input['userId']) && isset($input['productId'])) {
        $quantity = $input['quantity'];
        $userId = $input['userId'];
        $productId = $input['productId'];

        // Preparar e insertar los datos
        $stmt = $pdo->prepare("INSERT INTO carts (cart_quantity, user_id, product_id) VALUES (:quantity, :userId, :productId)");
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al ejecutar la consulta']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
