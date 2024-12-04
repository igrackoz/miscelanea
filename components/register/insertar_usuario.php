<?php

global $Conn;
require_once "../../includes/dbconnect.php";

function registrarUsuario($Conn, $nombre, $apellido, $calle, $numero, $email, $password){
    
    $query = "SELECT * FROM users WHERE user_email='$email'";
    $result = mysqli_query($Conn,$query);
    if(mysqli_num_rows($result) > 0){
        return false;
    }
    
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users(user_firstname, user_lastname, user_street, user_num_ext, user_email, user_password) VALUES ('$nombre','$apellido','$calle','$numero','$email','$password_hash')";
    $result = mysqli_query($Conn,$query);

    if($result){
        return true;
    } else {
        return false;
    }
}

if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['calle']) && isset($_POST['numero']) && isset($_POST['password']) && isset($_POST['password_verif'])){

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $password = $_POST['password'];
    $password_verif = $_POST['password_verif'];

    if($password !== $password_verif){
        header("Location: register.php?info=password_invalido");
        exit();
    }

    //$email = mysqli_real_escape_string($Conn, $email);

    $registro_resultado = registrarUsuario($Conn, $nombre, $apellido, $calle, $numero, $email, $password);
    
    if($registro_resultado){
        header("Location: ../login/login.php?info=registro_exitoso");
        exit();
    } else {
        header("Location: register.php?info=correo_duplicado");
        exit();
    }
}
?>
