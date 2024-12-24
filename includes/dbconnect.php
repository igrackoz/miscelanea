<?php

// Establecer la ubicación del archivo .env
if (file_exists('../../includes/.env')) {
    $envFile = '../../includes/.env';
} else {
    $envFile = '../includes/.env';
}

// Leer el archivo .env
$envContent = file_get_contents($envFile);

// Procesar las líneas del archivo .env
$lines = explode("\n", $envContent);

// Parsear el contenido del archivo .env en un arreglo de variables
foreach ($lines as $line) {
    // Ignorar líneas vacías y comentarios
    if (empty($line) || $line[0] === '#') {
        continue;
    }

    // Separar clave y valor por el signo igual
    list($key, $value) = explode('=', $line, 2);

    // Eliminar posibles espacios al inicio o final de la clave y valor
    $key = trim($key);
    $value = trim($value);

    // Asignar las variables de entorno a variables PHP
    putenv("$key=$value");
}

// Obtener las variables de entorno directamente con getenv()
$db_server = getenv('DB_SERVER');
$db_user = getenv('DB_USER');
$db_password = getenv('DB_PASSWORD');
$db_name = getenv('DB_NAME');
$smtp_password = getenv('SMTP_PASSWORD');

$Conn = mysqli_connect($db_server,$db_user,$db_password,$db_name) or
    die("Conexión fallida: ".mysqli_connect_error());
    mysqli_set_charset($Conn,"utf8");

