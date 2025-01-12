<?php

require 'dbconnect.php';

$capacity = 0;
$urlsArray = array();

if (isset($_GET['iddep']) && isset($_GET['idsubdep'])) {

    $iddep = $_GET['iddep'];
    $idsubdep = $_GET['idsubdep'];
    
    $query = "SELECT product_id, product_image, product_description, product_price, product_stock, product_available
                FROM products
                WHERE department_id = ".$iddep." AND segment_id = ".$idsubdep;
    $dataset = mysqli_query($Conn,$query);
    
    if ($dataset) {

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
                $urlsArray[] = "products.php?page=" . ($i + 1) . "&iddep=" . $iddep . "&idsubdep=" . $idsubdep . "&slot=" . $encoded_results;
                $results = [];
                $capacity = 0;
                $i++;
            }
        }

        if (!empty($results)) {
            $results_json = json_encode($results);
            $encoded_results = urlencode($results_json);
            $urlsArray[] = "products.php?page=" . ($i + 1) . "&iddep=" . $iddep . "&idsubdep=" . $idsubdep . "&slot=" . $encoded_results;
        }

        session_start();
        $_SESSION['urlsArray'] = $urlsArray;
        
        header("Location:../components/products/".$urlsArray[0]);
        exit();

    } else {
        echo "No se encontraron resultados.";
    }
    
} else if ($_GET['cool-search']){


} else {
    
    require "user-validation.php";

    $query = "SELECT p.product_id, p.product_image, p.product_description, p.product_price, p.product_stock, p.product_available, p.department_id, d.department_name
        FROM products p
        JOIN departments d ON p.department_id = d.department_id
        WHERE p.product_id IN (SELECT product_id FROM favorites WHERE user_id = ?)";
    $stmt = mysqli_prepare($Conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $dataset = mysqli_stmt_get_result($stmt);
    
    if ($dataset) {

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
                $urlsArray[] = "favorites.php?page=" . ($i + 1) . "&slot=" . $encoded_results;
                $results = [];
                $capacity = 0;
                $capacity++;
                $i++;
            }
        }

        if (!empty($results)) {
            $results_json = json_encode($results);
            $encoded_results = urlencode($results_json);
            $urlsArray[] = "favorites.php?page=" . ($i + 1) . "&slot=" . $encoded_results;
        }

        session_start();
        $_SESSION['urlsArray'] = $urlsArray;
        
        header("Location:../components/favorites/".$urlsArray[0]);
        exit();

    } else {
        echo "No se encontraron resultados.";
    }
}


try {

    $entrada = $_GET['cool-search'] ?? '';

    $query = "SELECT product_id, product_image, product_description, product_price, product_available, department_id, segment_id
                FROM products
                WHERE MATCH (product_description) AGAINST(? IN NATURAL LANGUAGE MODE);";
    $stmt = mysqli_prepare($Conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $entrada);
    mysqli_stmt_execute($stmt);
    $dataset = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($dataset) {

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
                $urlsArray[] = "result.php?page=" . ($i + 1) . "&search=" . $encoded_results;
                $results = [];
                $capacity = 0;
                $capacity++;
                $i++;
            }
        }

        if (!empty($results)) {
            $results_json = json_encode($results);
            $encoded_results = urlencode($results_json);
            $urlsArray[] = "result.php?page=" . ($i + 1) . "&search=" . $encoded_results;
        }

        session_start();
        $_SESSION['urlsArray'] = $urlsArray;
        
        header("Location:../components/result/".$urlsArray[0]);
        exit();

    } else {
        echo "No se encontraron resultados.";
    }
    
} catch (Exception $e) {
    echo "Error en la conexión: " . htmlspecialchars($e->getMessage());
}