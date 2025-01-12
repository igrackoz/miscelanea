<?php

require 'dbconnect.php';

$capacity = 0;
$urlsArray = array();

$entrada = $_GET['cool-search'] ?? '';

try {


    $query = "SELECT product_id, product_image, product_description, product_price, product_available, department_id, segment_id
                FROM products
                WHERE MATCH (product_description) AGAINST(? IN NATURAL LANGUAGE MODE);";
    $stmt = mysqli_prepare($Conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $entrada);
    mysqli_stmt_execute($stmt);
    $dataset = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    print_r($dataset);

    if ($dataset && $dataset->num_rows > 0) {

        $i = 0;
        $results = [];

        while ($row = mysqli_fetch_assoc($dataset)) {

            if ($capacity <= 18) {

                $results[] = $row;
                $capacity++;

            } else {

                $results[] = $row;
                $results_json = json_encode($results);
                $encoded_results = urlencode($results_json);
                $urlsArray[] = "result.php?page=" . ($i + 1) . "&busqueda=" . $entrada . "&search=" . $encoded_results;
                $results = [];
                $capacity = 0;
                $capacity++;
                $i++;
            }
        }

        if (!empty($results)) {
            $results_json = json_encode($results);
            $encoded_results = urlencode($results_json);
            $urlsArray[] = "result.php?page=" . ($i + 1) . "&busqueda=" . $entrada . "&search=" . $encoded_results;
        }

        session_start();
        $_SESSION['urlsArray'] = $urlsArray;
        
        header("Location:../components/result/".$urlsArray[0]);
        exit();

    } else {
        header("Location:../components/result/result.php?busqueda=".$entrada);
        exit();
    }
    
} catch (Exception $e) {
    echo "Error en la conexión: " . htmlspecialchars($e->getMessage());
}