<?php

include "../../includes/paths.php";
include $bp."head.php";
include $bp."user-validation.php";
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
                    } ?>
                    
                    <div class="box-product" class="box-dep" id="<?= $producto['product_id'] ?>">
                    <div class="box-product-image">
                        <img style="width: 100%; height: auto; aspect-ratio: 1 / 1 ;" src="../../images/departments/<?= $producto['department_id'] ?>/<?= $producto['product_image'] ?>">
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

        
        mysqli_close($Conn);
        
        ?>
        </div>
    </div>
    <div class="product-low-padding">
        <div style="font-size: 20px; height: 100px; width: 100%; display: flex; align-items: center; justify-content: center;">
            Página 1
        </div>
    </div>

</body>
</html>

<script>

const boxCatalog = document.querySelector('.box-catalog');
const boxProduct = document.querySelector('.box-product');

function adjustHeight() {

    const bar = document.querySelector('.bar');
    const coolNavbar = document.querySelector('.cool-navbar');
    const productLowPadding = document.querySelector('.product-low-padding');
    const boxProduct = document.querySelector('.box-product');
    
    const estilo = getComputedStyle(boxCatalog);
    const gap = parseFloat(estilo.gap);
    
    const boxProductHeight = parseFloat(getComputedStyle(boxProduct).height);
    let lessHeight;

    if (coolNavbar) {lessHeight = boxProductHeight + (gap * 2);}

    else {
        const barHeight = parseFloat(getComputedStyle(bar).height);
        lessHeight = boxProductHeight + barHeight + (gap * 2);
    }
    
    const totalHeight = window.innerHeight - lessHeight;
    
    productLowPadding.style.height = totalHeight + "px";
}



window.addEventListener('resize', adjustHeight);
window.addEventListener('scroll', adjustHeight);
window.addEventListener('load', adjustHeight);

</script>