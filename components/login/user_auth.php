<?php

global $Conn;
require_once "../../includes/dbconnect.php";

$email = $_POST['email'];
$password = $_POST['password'];



$query = "SELECT * FROM users WHERE user_email = '$email'";
$dataset = mysqli_query($Conn, $query);

if($dataset){
    
    if(mysqli_num_rows($dataset) > 0){
       
        $user = mysqli_fetch_assoc($dataset);
        
        if(password_verify($password, $user['user_password'])){

            session_start();
            $_SESSION['nombre'] = $user['user_firstname'];
            $_SESSION['apellido'] = $user['user_lastname'];

            header("Location: ../billboard/billboard.php");
            exit();
        }
        else {
            header("Location: login.php?info=usuario_invalido");
            exit();
        }
    }
    else {
        header("Location: login.php?info=usuario_invalido");
        exit();
    }
}
else {
    header("Location: login.php?info=usuario_invalido");
    exit();
}

?>