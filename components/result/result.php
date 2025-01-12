<?php

$bp = "../../includes/";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";

if (isset($_GET['busqueda'])) {
    $search = $_GET['busqueda'];
}

if (isset($_GET['page']) && isset($_SESSION['urlsArray'])) {

    $urlsArray = $_SESSION['urlsArray'];
    $page = $_GET['page'];
    
    if (isset($_GET['search'])) {
        $encoded_results = $_GET['search'];
        $results = json_decode(urldecode($encoded_results), true); // Decodificar y convertir de nuevo en array
    }

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
        include $bp."loading.php";
        include $bp."mobile-detector.php";
        include $detect->isTablet() || $detect->isMobile() ? $bp . "nav2.php" : $bp . "nav.php";
        $file_to_include = $detect->isTablet() || $detect->isMobile() ? "" : $bp . "contact.php";
        if (trim($file_to_include) !== "") {
            include $file_to_include;
        }
    ?>

<div style="padding-top: 50px; margin-bottom: 40px; display: flex; justify-content: center; align-items: center;">
        <img style="height: 100px; width: 150px; filter: brightness(0) saturate(100%) invert(38%) sepia(1%) saturate(1225%) hue-rotate(323deg) brightness(91%) contrast(93%);" src="../../images/logo2.svg" alt="">
    </div>
    <div style="padding-left: 20px; display: flex; justify-content: start; align-items: center; font-size: 22px; color: #333;">Buscaste:&nbsp;&nbsp;&nbsp;<strong><?php echo $search; ?></strong></div>

    <?php include $bp."page-number.php"; ?>
    <div class="main-container">
        <div class="box-catalog">
        <?php
        // Recorrer el array de resultados y mostrar los datos campo por campo
        if (isset($results)) {

            foreach ($results as $row) {
                    
                    if (isset($departmentMap[$row['department_id']])) {
                        // Reemplazamos el id con el nombre correspondiente
                        $row['department_id'] = $departmentMap[$row['department_id']];
                    } 
                    
                    $favorite = true;

                    if (mysqli_num_rows($favorite_dataset) > 0) {

                        mysqli_data_seek($favorite_dataset, 0);

                        while ($favorite_row = mysqli_fetch_assoc($favorite_dataset)) {
                            
                            if ($favorite_row['product_id'] == $row['product_id']) {
                                $favorite = false;
                            }
                        }
                    }

                    ?>
                    
                    <div class="box-product" class="box-dep" id="<?= $row['product_id'] ?>">
                    <div class="box-product-image">
                        <div class="box-product-favorite" id="box-product-favorite<?= $row['product_id'] ?>" onclick="favorite(<?= $id . ',' . $row['product_id'] ?>,<?= $favorite ? '1' : '0' ?>)">
                            <img class="heart-icon<?= $row['product_id'] ?>" src="../../images/<?= $favorite ? 'heart' : 'heart-fill' ?>.svg">
                        </div>
                        <img class="box-product-photo product-image-charge<?= $row['product_id'] ?>" style="width: 100%; height: auto; aspect-ratio: 1 / 1 ;" src="../../images/product.svg" data-original="../../images/departments/<?= $row['department_id'] ?>/<?= $row['product_image'] ?>">
                    </div>
                    <div class="box-product-name">
                        <?= $row['product_description'].'<br>' ?>
                    </div>
                    <div class="box-product-price">
                        <?= "$   ". number_format($row['product_price'], 2).'<br>' ?>
                    </div>
                    <div class="box-product-button">
                        <div class="minus red" onclick="remove(<?= $row['product_id'] . ',\'' . number_format($row['product_price'], 2) . '\'' ?>, 1)">
                            <img src="../../images/minus.svg" alt="">
                        </div>
                        <div class="quantity" id="cantidad<?= $row['product_id'] ?>"></div>
                        <div class="plus red" id="letrero<?= $row['product_id'] ?>" onclick="add(<?= $row['product_id'] . ',\'' . addslashes($row['product_description']) . '\',\''. $row['department_id'] .'\',\'' . number_format($row['product_price'], 2) . '\',\'' . addslashes($row['product_image']) . '\'' ?>, 1)">
                            <div class="plus-string">Añadir</div>
                            <img src="../../images/plus.svg" class="plus-image">
                        </div>
                    </div>
                </div>

                <script>
                    const images<?= $row['product_id'] ?> = document.querySelectorAll('.product-image-charge<?= $row['product_id'] ?>');
                    imageLoader(images<?= $row['product_id'] ?>);
                </script>

            <?php } ?>

        <?php } else { ?>

            <div style="
                height: 300px;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                gap: 30px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <img src="../../images/emoji-frown.svg">
                <div>
                    <div style="font-size: 28px; font-weight: bold; color: #333; text-align: center;">No se encontraron coincidencias.</div>
                    <div style="font-size: 18px; color: #333; text-align: center;">Intenta una nueva busqueda en el navegador.</div>
                </div>
            </div>
        
        <?php } ?>

        </div>
    </div>
    <?php include $bp."page-number.php"; ?>
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