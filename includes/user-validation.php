<?php

session_start();

if(isset($_SESSION['id']) &&
    isset($_SESSION['nombre']) &&
    isset($_SESSION['apellido']) &&
    isset($_SESSION['calle']) &&
    isset($_SESSION['numero_exterior']) &&
    isset($_SESSION['telefono']) &&
    isset($_SESSION['email']) &&
    isset($_SESSION['color'])){
    
    $id = $_SESSION['id'];
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $calle = $_SESSION['calle'];
    $numero_exterior = $_SESSION['numero_exterior'];
    $telefono = $_SESSION['telefono'];
    $email = $_SESSION['email'];
    $color = $_SESSION['color'];

} else { }

?>