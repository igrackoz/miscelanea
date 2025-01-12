<?php

session_start();

if(isset($_SESSION['id'])){
    
    $id = $_SESSION['id'];
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $calle = $_SESSION['calle'];
    $numero_exterior = $_SESSION['numero_exterior'];
    $telefono = $_SESSION['telefono'];
    $email = $_SESSION['email'];
    $color = $_SESSION['color'];

} else { 

    $id = 0;
}

?>