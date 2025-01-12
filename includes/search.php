<?php

$entrada = $_GET['cool-search'] ?? '';
// echo "Entrada original: " . htmlspecialchars($entrada) . "<br>";

$separador = ' ';
$arreglo = explode($separador, $entrada);

$conectores = ['el', 'la', 'los', 'las', 'le', 'de', 'para', 'con', 'en', 'y', 'o', 'a', 'al'];

$resultado = array_filter($arreglo, function ($palabra) use ($conectores) {
    return trim($palabra) !== '' && !in_array(strtolower($palabra), $conectores);
});

// echo "Palabras filtradas: " . htmlspecialchars(implode(', ', $resultado)) . "<br>";

require 'dbconnect.php';

try {

    $pdo = new PDO('mysql:host='.$db_server.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $resultadosTotales = [];

    foreach ($resultado as $entrada) {

        $entradaLike = "%" . $entrada . "%";
        $query = $pdo->prepare("SELECT product_id, product_image, product_description, product_price, product_available, department_id  FROM products WHERE product_description LIKE :entrada");
        $query->execute([':entrada' => $entradaLike]);

        $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($resultados) {
            $resultadosTotales[$entrada] = $resultados; // Guardar resultados en el array de resultados
            break;
        } else {
            $resultadosTotales[$entrada] = []; // No hay resultados para esta entrada
        }
    }

    // Convertir los resultados a una cadena que pueda ser pasada como parámetro GET
    $resultadosCodificados = urlencode(serialize($resultadosTotales));

    // Redirigir a la página result.php con los resultados en la URL
    header('Location: ../components/result/result.php?resultados=' . $resultadosCodificados);
    exit;  // Asegúrate de que el script no siga ejecutándose después de la redirección

} catch (PDOException $e) {
    echo "Error en la conexión: " . htmlspecialchars($e->getMessage());
}