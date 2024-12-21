<?php

// Función para cargar el archivo .env
function loadEnv($file)
{
    if (file_exists($file)) {
        $variables = parse_ini_file($file);
        foreach ($variables as $key => $value) {
            putenv("$key=$value");
        }
    }
}

// Cargar las variables de entorno desde el archivo .env
loadEnv(__DIR__ . '/.env');

// Usar las variables de entorno para la conexión.
$servername = getenv('DB_SERVER');
$usr = getenv('DB_USER');
$pwd = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

$Conn = mysqli_connect($servername,$usr,$pwd,$dbname) or
    die("Conexión fallida: ".mysqli_connect_error());
    mysqli_set_charset($Conn,"utf8");

?>