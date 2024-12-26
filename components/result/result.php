<?php

$bp = "../../includes/";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";

// Asegúrate de que $Conn esté correctamente definido

if (isset($_GET['resultados'])) {
    $resultadosCodificados = $_GET['resultados'];
    $resultadosTotales = unserialize(urldecode($resultadosCodificados));
} else {
    echo "<p>No se han recibido resultados de búsqueda.</p>";
}


$query = "SELECT department_id, department_name FROM departments";
$dataset = mysqli_query($Conn, $query);

// Construimos un mapa para convertir department_id en department_name
$departmentMap = [];
while ($row = mysqli_fetch_assoc($dataset)) {
    $departmentMap[$row['department_id']] = $row['department_name'];
}

$product_query = "SELECT p.product_id, p.product_image, p.product_description, p.product_price, p.product_stock, p.product_available, p.department_id, d.department_name
          FROM products p
          JOIN departments d ON p.department_id = d.department_id
          WHERE p.product_id IN (SELECT product_id FROM favorites WHERE user_id = ?)";
$product_stmt = mysqli_prepare($Conn, $product_query);
mysqli_stmt_bind_param($product_stmt, 'i', $id);
mysqli_stmt_execute($product_stmt);
$product_dataset = mysqli_stmt_get_result($product_stmt);

$favorite_query = "SELECT favorite_id, product_id, user_id FROM favorites WHERE user_id = ?";
$favorite_stmt = mysqli_prepare($Conn, $favorite_query);
mysqli_stmt_bind_param($favorite_stmt, 'i', $id);
mysqli_stmt_execute($favorite_stmt);
$favorite_dataset = mysqli_stmt_get_result($favorite_stmt);

mysqli_close($Conn);

?>


<body>
    <?php
        include $bp."mobile-detector.php";
        include $detect->isTablet() || $detect->isMobile() ? $bp . "nav2.php" : $bp . "nav.php";
        include $bp."contact.php";
        include "../../dev/dev.php";
    ?>

    <div style="height: 50px;"></div>
    <div style="font-size: 30px; font-weight: light;">Buscaste: ...</div>
    <div style="height: 50px;"></div>

    <div class="main-container">
        <div class="box-catalog">
        <?php
        // Recorrer el array de resultados y mostrar los datos campo por campo
        foreach ($resultadosTotales as $entrada => $productos) {

            // Revisamos si hay productos en esta categoría
            if (!empty($productos)) {
                foreach ($productos as $producto) {
                    
                    if (isset($departmentMap[$producto['department_id']])) {
                        // Reemplazamos el id con el nombre correspondiente
                        $producto['department_id'] = $departmentMap[$producto['department_id']];
                    } 
                    
                    $favorite = true;

                    if (mysqli_num_rows($favorite_dataset) > 0) {

                        mysqli_data_seek($favorite_dataset, 0);

                        while ($favorite_row = mysqli_fetch_assoc($favorite_dataset)) {
                            
                            if ($favorite_row['product_id'] == $producto['product_id']) {
                                $favorite = false;
                            }
                        }
                    }

                    ?>
                    
                    <div class="box-product" class="box-dep" id="<?= $producto['product_id'] ?>">
                    <div class="box-product-image">
                        <div class="box-product-favorite" id="box-product-favorite<?= $producto['product_id'] ?>" onclick="favorite(<?= $id . ',' . $producto['product_id'] ?>,<?= $favorite ? '1' : '0' ?>)">
                            <img class="heart-icon<?= $producto['product_id'] ?>" src="../../images/<?= $favorite ? 'heart' : 'heart-fill' ?>.svg">
                        </div>
                        <img class="box-product-photo" style="width: 100%; height: auto; aspect-ratio: 1 / 1 ;" src="../../images/departments/<?= $producto['department_id'] ?>/<?= $producto['product_image'] ?>">
                    </div>
                    <div class="box-product-name">
                        <?= $producto['product_description'].'<br>' ?>
                    </div>
                    <div class="box-product-price">
                        <?= "$   ". $producto['product_price'].'<br>' ?>
                    </div>
                    <div class="box-product-button">
                        <div class="minus red" onclick="remove(<?= $producto['product_id'] . ',\'' . $producto['product_price'] . '\'' ?>, 1)">
                            <img src="../../images/minus.svg" alt="">
                        </div>
                        <div class="quantity" id="cantidad<?= $producto['product_id'] ?>"></div>
                        <div class="plus red" id="letrero<?= $producto['product_id'] ?>" onclick="add(<?= $producto['product_id'] . ',\'' . addslashes($producto['product_description']) . '\',\''. $producto['department_id'] .'\',\'' . $producto['product_price'] . '\',\'' . addslashes($producto['product_image']) . '\'' ?>, 1)">
                            <div class="plus-string">Añadir</div>
                            <img src="../../images/plus.svg" class="plus-image">
                        </div>
                    </div>
                </div>
                <?php }
            } else {
                echo "<p>No se encontraron productos para esta búsqueda.</p><br>";
            }
        }
        
        ?>
        </div>
    </div>
    <div style="font-size: 20px; height: 100px; width: 100%; display: flex; align-items: center; justify-content: center;">
        Página 1
    </div>
    <?php include '../../includes/footer-image.php'; ?>
</body>
</html>

<script>

function favorite(userId,productId,Add) {
    
    const favorite = document.getElementById('box-product-favorite' + productId);
    const heart = document.querySelector('.heart-icon' + productId);
    favorite.setAttribute('onclick', ``);

    let link = "";

    const data = {
        userId: userId,
        productId: productId
    };

    link = Add ? '../../includes/favorites.php' : '../../includes/unfavorites.php';

    fetch(link, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status} - ${response.statusText}`);
        }
        return response.text(); // O `response.json()` si el servidor devuelve JSON
    })
    .then(result => {
        let icon = Add ? '../../images/heart-fill.svg' : '../../images/heart.svg';
        heart.src = icon;
        console.log(icon);
        favorite.setAttribute('onclick', `favorite(${userId},${productId},${Add ? 0 : 1})`);

        console.log('Respuesta del servidor:', result);
    })
    .catch(error => {
        console.error('Error al realizar la solicitud:', error);
    });
}

</script>