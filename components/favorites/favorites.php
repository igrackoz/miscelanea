<?php

$bp = "../../includes/";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";

$urlsArray = $_SESSION['urlsArray'];
$page = $_GET['page'];

if (isset($_GET['slot'])) {
    $encoded_results = $_GET['slot'];
    $results = json_decode(urldecode($encoded_results), true); // Decodificar y convertir de nuevo en array
}

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

    <div class="fade-top">
        <div class="dep-title">FAVORITOS</div>
    </div>

    <div style="padding-top: 50px; margin-bottom: 20px; display: flex; justify-content: center; align-items: center;">
        <img style="height: 100px; width: 150px; filter: brightness(0) saturate(100%) invert(38%) sepia(1%) saturate(1225%) hue-rotate(323deg) brightness(91%) contrast(93%);" src="../../images/logo2.svg" alt="">
    </div>
    <div style="display: flex; justify-content: center; align-items: center; font-size: 30px;">FAVORITOS</div>
    <?php include $bp."page-number.php"; ?>
    <div class="main-container">
        <div class="box-catalog">
        
        <?php

        if ($results) {

            foreach ($results as $row) {

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
                        <img class="box-product-photo product-image-charge<?= $row['product_id'] ?>" style="width: 100%; height: auto; aspect-ratio: 1 / 1 ;" src="../../images/product.svg" data-original="../../images/departments/<?= $row['department_name'] ?>/<?= $row['product_image'] ?>">
                    </div>
                    <div class="box-product-name">
                        <?= $row['product_description'] ?>
                    </div>
                    <div class="box-product-price">
                        <?= "$   ". number_format($row['product_price'], 2) ?>
                    </div>
                    <div class="box-product-button">
                        <div class="minus red" onclick="remove(<?= $row['product_id'] . ',\'' . number_format($row['product_price'], 2) . '\'' ?>, 1)">
                            <img src="../../images/minus.svg" alt="">
                        </div>
                        <div class="quantity" id="cantidad<?= $row['product_id'] ?>"></div>
                        <div class="plus red" id="letrero<?= $row['product_id'] ?>" onclick="add(<?= $row['product_id'] . ',\'' . addslashes($row['product_description']) . '\',\''. $row['department_name'] .'\',\'' . $row['product_price'] . '\',\'' . addslashes($row['product_image']) . '\'' ?>, 1)">
                            <div class="plus-string">Añadir</div>
                            <img src="../../images/plus.svg" class="plus-image">
                        </div>
                    </div>
                </div>
                
                <script>
                    const images<?= $row['product_id'] ?> = document.querySelectorAll('.product-image-charge<?= $row['product_id'] ?>');
                    imageLoader(images<?= $row['product_id'] ?>);
                </script>

            <?php }
        } ?>

        </div>
    </div>
    <?php include $bp."page-number.php"; ?>
    <?php include $bp."footer-image.php"; ?>
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

const boxCatalog = document.querySelector('.box-catalog');

function fadeAppear(){
    
    const fadeTop = document.querySelector('.fade-top');
    const rect = boxCatalog.getBoundingClientRect();

    if (rect.top < 0) {

        fadeTop.classList.add('show');
    } else {

        fadeTop.classList.remove('show');
    }
}

window.addEventListener('scroll', fadeAppear);
window.addEventListener('load', fadeAppear);

</script>