<?php

header("Cache-Control: max-age=3600");

require "../../includes/dbconnect.php";

// Capturar el valor del input de búsqueda si está definido
$search = isset($_GET['search']) ? mysqli_real_escape_string($Conn, $_GET['search']) : '';

// Construir la consulta con un filtro opcional por product_description
$query = "SELECT * FROM products";
if (!empty($search)) {
    $query .= " WHERE product_description LIKE '%$search%'";
}

$dataset = mysqli_query($Conn, $query);

?>

<?php include "../global/head.php"; ?>
<body>
    <a href="../panel/panel.php"><h1>PANEL</h1></a>
    <br>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Buscar por descripción" value="<?= $search ?>">
        <button type="submit">Buscar</button>
    </form>
    <br>

    <?php

    if ($dataset && $dataset->num_rows > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>";

        // Mostrar los nombres de las columnas en la primera fila
        $columnas = array_keys($dataset->fetch_assoc()); // Obtener las claves del primer registro
        foreach ($columnas as $columna) {
            echo "<th>" . $columna . "</th>";
        }

        echo "</tr>";

        // Volver al primer registro (ya que fetch_assoc() movió el cursor)
        $dataset->data_seek(0);

        // Mostrar los datos en las filas siguientes
        while ($row = $dataset->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $valor) {
                // Suponiendo que 'id' es el campo que contiene el ID único de cada registro
                if ($key == 'product_id') {
                    // Crear un enlace con el ID
                    echo "<td><a href='../modificarmodificar.php?id=" . urlencode($valor) . "'>Modificar</a></td>";
                } else {
                    // Mostrar los demás valores
                    echo "<td>" . $valor . "</td>";
                }
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }

    ?>

</body>
</html>
