<?php

session_start();

if(isset($_SESSION['nombre']) && isset($_SESSION['apellido']) && isset($_SESSION['color'])){
    
    header("Location: ../billboard/billboard.php");
    exit();
} else { }

?>