<?php

$bp = "../../includes/";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";

$iddep = $_GET['iddep'];

/*
    $query = "SELECT department_name FROM departments WHERE department_id = ".$iddep;
    $dataset = mysqli_query($Conn,$query);
    $departmentName = mysqli_fetch_assoc($dataset)['department_name'];
*/

$query = "SELECT department_name FROM departments WHERE department_id = ?";
$stmt = $Conn->prepare($query);
$stmt->bind_param("i", $iddep);
$stmt->execute();
$result = $stmt->get_result();
$departmentName = $result->fetch_assoc()['department_name'] ?? null;

$query = "SELECT segment_id, segment_name, segment_image, department_id FROM segments WHERE department_id = ?";
$stmt = $Conn->prepare($query);
$stmt->bind_param("i", $iddep);
mysqli_stmt_execute($stmt);
$segment_dataset = mysqli_stmt_get_result($stmt);

$query2 = "SELECT product_id, product_image, product_description, product_price, product_stock, product_available
            FROM products
            WHERE department_id = ".$iddep;
$dataset2 = mysqli_query($Conn,$query2);

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
        include "../../dev/dev.php";
    ?>

    <div class="fade-top">
        <div class="subdep-title"><?= htmlspecialchars($departmentName) ?></div>
    </div>

    <div style="padding-top: 50px; padding-bottom: 20px; display: flex; justify-content: center; align-items: center;">
        <img style="height: 100px; width: 150px; filter: brightness(0) saturate(100%) invert(38%) sepia(1%) saturate(1225%) hue-rotate(323deg) brightness(91%) contrast(93%);" src="../../images/logo2.svg" alt="">
    </div>
    <div style="margin-bottom: 50px;  display: flex; justify-content: center; align-items: center; font-size: 30px; color:rgb(48, 48, 48);"><?= htmlspecialchars($departmentName) ?></div>
    
    <div class="main-container">
        <div class="box-catalog">
        
            <?php

            if (mysqli_num_rows($segment_dataset) > 0) {

                while ($segment_row = mysqli_fetch_assoc($segment_dataset)) { ?>

                    <a href="../../includes/paging.php?iddep=<?= $segment_row['department_id'] ?>&idsubdep=<?= $segment_row['segment_id'] ?>" class="box-segment" class="box-subdep" id="<?= $segment_row['segment_id'] ?>">
                        <div class="box-segment-image">
                            <img class="box-segment-photo subdep-image-charge<?= $segment_row['segment_id'] ?>" src="../../images/groceries.svg" data-original="../../images/departments/<?= htmlspecialchars($departmentName) ?>/<?= $segment_row['segment_name'] ?>/<?= $segment_row['segment_image'] ?>">
                        </div>
                        <div class="box-segment-name">
                            <?= $segment_row['segment_name'] ?>
                        </div>
                    </a>
                    <script>
                        const images<?= $segment_row['segment_id'] ?> = document.querySelectorAll('.subdep-image-charge<?= $segment_row['segment_id'] ?>');

                        images<?= $segment_row['segment_id'] ?>.forEach(image => {
                            // Guardar el src original
                            const originalSrc = image.getAttribute('data-original');

                            // Crear una nueva instancia para cargar la imagen original
                            const tempImg = new Image();
                            tempImg.src = originalSrc;

                            tempImg.onload = function () {
                                // Ocultar temporalmente la imagen de carga
                                image.style.transition = 'none'; // Quitar transición para ocultar inmediatamente
                                image.style.opacity = '0';

                                // Cambiar el src a la imagen original
                                setTimeout(() => {
                                    image.src = originalSrc;

                                    // Aplicar el fade-in después de actualizar el src
                                    image.style.transition = 'opacity 0.5s';
                                    image.style.opacity = '1';
                                }, 50); // Pequeño retraso para asegurar el cambio de src
                            };

                            tempImg.onerror = function () {
                                // En caso de error, mostrar una imagen alternativa
                                image.src = '../../images/error.svg';
                                image.style.opacity = '1';
                            };
                        });
                    </script>

                <?php }
            } ?>

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