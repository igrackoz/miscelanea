<?php

global $Conn;
$bp = "../../includes/";
include $bp."dbconnect.php";

function registrarUsuario($Conn, $nombre, $apellido, $telefono, $calle, $numero, $email, $password, $color){
    
    $query = "SELECT * FROM users WHERE user_email='$email'";
    $result = mysqli_query($Conn,$query);
    if(mysqli_num_rows($result) > 0){
        $info = "correo_duplicado";
        return false;
    }
    
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users(user_firstname, user_lastname, user_phone, user_street, user_num_ext, user_email, user_password, user_color_picker) VALUES ('$nombre','$apellido','$telefono','$calle','$numero','$email','$password_hash','$color')";
    $result = mysqli_query($Conn,$query);

    if($result){
        $info = "correo_duplicado";
        return true;
    } else {
        return false;
    }
}

if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['calle']) && isset($_POST['numero']) && isset($_POST['password']) && isset($_POST['password_verif'])){

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $password = $_POST['password'];
    $password_verif = $_POST['password_verif'];

    if($password !== $password_verif){
        $info = "password_match";
        header("Location: register.php?info=" . $info);
        exit();
    }

    //$email = mysqli_real_escape_string($Conn, $email);
    
    $color = rand(0, 360);

    $registro_resultado = registrarUsuario($Conn, $nombre, $apellido, $telefono, $calle, $numero, $email, $password, $color);
    
    if($registro_resultado){
        $info = "registro_exitoso";
        header("Location: ../login/login.php?info=" . $info);
        exit();
    } else {
        $info = "correo_duplicado";
        header("Location: register.php?info=" . $info);
        exit();
    }
}
?>
