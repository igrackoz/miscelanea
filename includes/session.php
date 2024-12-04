<?php

session_start();

if(isset($_SESSION['nombre']) && isset($_SESSION['apellido'])){
    
    header("Location: ../billboard/billboard.php");
    exit();
} else { }

?>