<?php

$servername = "localhost";
$usr = "root";
$pwd = "1234";
$dbname = "tienda_ana";

$Conn = mysqli_connect($servername,$usr,$pwd,$dbname) or
    die("Conexión fallida: ".mysqli_connect_error());
    mysqli_set_charset($Conn,"utf8");

?>