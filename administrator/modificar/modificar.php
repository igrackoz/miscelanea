<?php
header("Cache-Control: max-age=3600");
//$id = $_GET['id'];

if (isset($_GET['item'])) {

    if ($_GET['item'] == "updated") {
        $updated = true;
    } else {
        $updated = false;
    }

} else {
    $updated =  false;
}

require "../../includes/dbconnect.php";
$query = "SELECT * FROM products WHERE product_id = $id";
$dataset = mysqli_query($Conn, $query);

if ($dataset) {
    $product = mysqli_fetch_assoc($dataset); // Obtener los datos del producto
} else {
    echo "Error al obtener los datos del producto.";
    exit;
}
?>

<?php include "../global/head.php"; ?>
<body>
    <a href="../panel/panel.php"><h1>PANEL</h1></a>
    
    <?php if ($updated) { ?>
        
        <div style="display: flex; align-items: center; justify-content: start; padding-left: 20px; height: 50px; background-color: #95f0ad; border: 1px solid green; border-radius: 10px; color: green;">
            <div>producto actualizado correctamente</div>
        </div>
        <br> 

    <?php } ?>

    <!-- Formulario para editar el producto -->
    <form action="update.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

        <!-- Campo para el código de barras  -->
        <label for="product_code">Código de barras:</label>
        <input type="text" id="product_code" name="product_code" value="<?php echo $product['product_code']; ?>" required>
        <br>

        <!-- Campo para la descripción -->
        <label for="product_description">Descripción:</label>
        <input type="text" id="product_description" name="product_description" value="<?php echo $product['product_description']; ?>" required>
        <br><br>

        <!-- Campo para la descripción -->
        <label for="product_type">Descripción:</label>
        <select id="product_type" name="product_type" required>
            <option value="unidad" <?php echo ($product['product_type'] == 'unidad') ? 'selected' : ''; ?>>unidad</option>
            <option value="granel" <?php echo ($product['product_type'] == 'granel') ? 'selected' : ''; ?>>granel</option>
            <option value="paquete" <?php echo ($product['product_type'] == 'paquete') ? 'selected' : ''; ?>>paquete</option>
        </select>
        <br><br>

        <!-- Campo para el costo -->
        <label for="product_cost">Costo:</label>
        <input type="number" id="product_cost" name="product_cost" value="<?php echo $product['product_cost']; ?>" required>
        <br>

        <!-- Campo para el precio -->
        <label for="product_price">Precio:</label>
        <input type="number" id="product_price" name="product_price" value="<?php echo $product['product_price']; ?>" required>
        <br>
        <br>
        <div id="product_gain">Ganancia: <?= number_format(((float)$product['product_price'] / (float)$product['product_cost'] * 100 - 100), 2) ?>%</div>
        <br>

        <!-- Campo para la cantidad -->
        <label for="product_stock">Inventario:</label>
        <input type="number" id="product_stock" name="product_stock" value="<?php echo $product['product_stock']; ?>" <?= (isset($_GET['new'])) ? '' : 'disabled'; ?>>
        <br>

        <!-- Campo para el minimo -->
        <label for="product_minimum">mínimo:</label>
        <input type="number" id="product_minimum" name="product_minimum" value="<?php echo $product['product_minimum']; ?>" required>
        <br>

        <!-- Campo para el máximo -->
        <label for="product_maximum">máximo:</label>
        <input type="number" id="product_maximum" name="product_maximum" value="<?php echo $product['product_maximum']; ?>" required>
        <br><br>

        <!-- Botón para cancelar y volver a la página anterior -->
        <a href="../consultar/consultar.php"><button type="button">Cancelar</button></a>

        <!-- Botón para enviar el formulario -->
        <button type="submit">Guardar cambios</button>
    </form>

</body>
</html>

<script>

// Selecciona los inputs y el resultado
let input1 = document.getElementById('product_cost');
let input2 = document.getElementById('product_price');
let resultado = document.getElementById('product_gain');

// Función para realizar el cálculo
function calcular() {
    // Obtener los valores de los inputs
    let valor1 = parseFloat(input1.value);
    let valor2 = parseFloat(input2.value);
    
    // Verificar si los valores son números válidos
    if (isNaN(valor1) || isNaN(valor2)) {
        resultado.innerText = "Por favor ingresa valores válidos en ambos campos.";
    } else {
        // Realizar el cálculo
        let resultadoC = valor2 / valor1 * 100 - 100; // o cualquier otro cálculo
        resultado.innerText = "Ganancia: " + resultadoC.toFixed(2) + "%";
    }
}

// Ejecutar el cálculo cada vez que el valor cambie en cualquiera de los dos inputs
input1.addEventListener('input', calcular);
input2.addEventListener('input', calcular);


</script>