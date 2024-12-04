<?php
// Configurar el encabezado para permitir el acceso CORS y retornar JSON
header('Content-Type: application/json');

// Obtener la consulta de búsqueda
$query = isset($_GET['q']) ? strtolower(trim($_GET['q'])) : '';

// Simular una base de datos
$items = ['Manzana', 'Banana', 'Naranja', 'Fresa', 'Sandía', 'Melón', 'Pera', 'Durazno'];

// Filtrar los resultados según la consulta
$results = array_filter($items, function($item) use ($query) {
    return strpos(strtolower($item), $query) !== false;
});

// Retornar los resultados en formato JSON
echo json_encode(array_values($results));
