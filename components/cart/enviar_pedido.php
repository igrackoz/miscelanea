<?php

if (isset($_GET['products'])) {
    $items = explode(",", urldecode($_GET['products']));
    // Ahora puedes usar el arreglo $items en PHP
    print_r($items);

    header("location:send.php");
}

?>    