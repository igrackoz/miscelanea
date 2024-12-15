<?php

include "../../includes/paths.php";
include $bp."head.php";
include $bp."user-validation.php";
include $bp."dbconnect.php";

$iddep = $_GET['iddep'];

$query = "SELECT department_name FROM departments WHERE department_id = ".$iddep;
$dataset = mysqli_query($Conn,$query);
$departmentName = mysqli_fetch_assoc($dataset)['department_name'];


$query2 = "SELECT product_id, product_image, product_description, product_price, product_stock, product_available
            FROM products
            WHERE department_id = ".$iddep;
$dataset2 = mysqli_query($Conn,$query2);

mysqli_close($Conn);

?>

<body>
    <?php
        include $bp."mobile-detector.php";
        include $detect->isTablet() || $detect->isMobile() ? $bp . "nav2.php" : $bp . "nav.php";
        include $bp."contact.php";
        include "../../dev/dev.php";
    ?>

    <div class="fade-top">
        <div class="dep-title"><?= htmlspecialchars($departmentName) ?></div>
    </div>

    <div style="margin-top: 50px; margin-bottom: 20px; display: flex; justify-content: center; align-items: center;">
        <img style="height: 100px; width: 150px; filter: brightness(0) saturate(100%) invert(38%) sepia(1%) saturate(1225%) hue-rotate(323deg) brightness(91%) contrast(93%);" src="../../images/logo2.svg" alt="">
    </div>
    <div style="margin-bottom: 50px;  display: flex; justify-content: center; align-items: center; font-size: 30px; color:rgb(48, 48, 48);"><?= htmlspecialchars($departmentName) ?></div>
    
    <div class="main-container">
        <div class="box-catalog">
        
        <?php

        if (mysqli_num_rows($dataset2) > 0) {

            while ($row2 = mysqli_fetch_assoc($dataset2)) {?>

                <div class="box-product" class="box-dep" id="<?= $row2['product_id'] ?>">
                    <div class="box-product-image">
                        <img style="width: 100%; height: auto; aspect-ratio: 1 / 1 ;" src="../../images/departments/<?= htmlspecialchars($departmentName) ?>/<?= $row2['product_image'] ?>">
                    </div>
                    <div class="box-product-name">
                        <?= $row2['product_description'] ?>
                    </div>
                    <div class="box-product-price">
                        <?= "$   ". $row2['product_price'] ?>
                    </div>
                    <div class="box-product-button">
                        <div class="minus red" onclick="remove(<?= $row2['product_id'] . ',\'' . $row2['product_price'] . '\'' ?>, 1)">
                            <img src="../../images/minus.svg" alt="">
                        </div>
                        <div class="quantity" id="cantidad<?= $row2['product_id'] ?>"></div>
                        <div class="plus red" id="letrero<?= $row2['product_id'] ?>" onclick="add(<?= $row2['product_id'] . ',\'' . addslashes($row2['product_description']) . '\',\''. htmlspecialchars($departmentName) .'\',\'' . $row2['product_price'] . '\',\'' . addslashes($row2['product_image']) . '\'' ?>, 1)">
                            <div class="plus-string">Añadir</div>
                            <img src="../../images/plus.svg" class="plus-image">
                        </div>
                    </div>
                </div>

            <?php }
        }

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