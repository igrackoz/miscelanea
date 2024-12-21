<?php

global $Conn;
require_once "../../includes/dbconnect.php";
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE user_email = '$email'";
$dataset = mysqli_query($Conn, $query);
$query = "SELECT * FROM users WHERE user_email = ?";
$stmt = mysqli_prepare($Conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$dataset = mysqli_stmt_get_result($stmt);

if($dataset){
    
    if(mysqli_num_rows($dataset) > 0){
       
        $user = mysqli_fetch_assoc($dataset);
        
        if(password_verify($password, $user['user_password'])){

            session_start();
            $_SESSION['id'] = $user['user_id'];
            $_SESSION['nombre'] = $user['user_firstname'];
            $_SESSION['apellido'] = $user['user_lastname'];
            $_SESSION['color'] = $user['user_color_picker'];

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