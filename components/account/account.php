<?php

$bp = "../../includes/";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";

$userid = $_GET['userid'];

$query = "SELECT user_id, user_email, user_street, user_num_ext, user_phone FROM users WHERE user_id = ".$userid;
$dataset = mysqli_query($Conn,$query);
$row = mysqli_fetch_assoc($dataset);

$favorite_query = "SELECT favorite_id, product_id, user_id FROM favorites WHERE user_id = ?";
$favorite_stmt = mysqli_prepare($Conn, $favorite_query);
mysqli_stmt_bind_param($favorite_stmt, 'i', $id);
mysqli_stmt_execute($favorite_stmt);
$favorite_dataset = mysqli_stmt_get_result($favorite_stmt);
$favorite_row = mysqli_num_rows($favorite_dataset);

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
    <div style="height: 50px;"></div>
    <div style="height: 150px; width: 100%; margin-bottom: 30px; display: flex; gap: 20px; flex-direction: column; align-items: center; justify-content:space-around;">
        <div style="height: 100px; width: 100px;">
        
        <div>
            <div id="letter-image" style="overflow: hidden;
                height: 100px;
                width: 100px;
                border-radius: 50%;
                background-color: hsl(<?= $color ?>, 40%, 80%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                color: hsl(<?= $color ?>, 40%, 40%);
                font-size: 40px;">

                <?php 

                $firstname_letter = strtoupper(substr($nombre, 0, 1));
                $lastname_letter = strtoupper(substr($apellido, 0, 1));

                echo $firstname_letter.''.$lastname_letter;
                
                ?>

            </div>
        </div>

        </div>
        <div><?= $nombre.' '.$apellido ?></div>
    </div>

    <style>

        .address{

            display: flex;
            padding-left: 10px;
            color: #555;
            height: 60px;
            display: flex;
            align-items:center;
            justify-content: start;
        }

    </style>
    
    <div style="margin-left: 10px; margin-right: 10px; border-radius: 10px; background-color: white; box-shadow: -1px 2px 42px -48px rgba(0,0,0,0.75);">
        <div class="address">
            <div><?= $row['user_email'] ?></div>
        </div>
        <div style="background-color: #ccc; height: 1px; width: 100%;"></div>
        <div class="address">
            <div><?= $row['user_street'].", #".$row['user_num_ext'] ?></div>
        </div>
        <div style="background-color: #ccc; height: 1px; width: 100%;"></div>
        <div class="address">
            <div><?= $row['user_phone'] ?></div>
        </div>
    </div>

    <div style="display: flex; border-radius: 10px; gap: 10px; padding: 20px; justify-content: center; align-items: start; color: white; background-color:rgb(17, 94, 194); width: auto; margin-left: 10px; margin-right: 10px; margin-top: 10px;">
        <img style="margin-top: 4px;" src="../../images/exclamation-circle.svg">
        <div>
            Sus datos de dirección serán usados con la finalidad de otorgar un servicio de entrega a domicilio óptimo y eficiente.
        </div>
    </div>

    <div class="account-container">
        <a href="../cart/cart.php" class="cart-box">
            <div class="cart-box-top"></div>
            <div class="cart-box-middle">
                <img src="../../images/cart-fill-panel.svg">
                <div class="cart-box-middle-text"></div>
            </div>
            <div class="cart-box-bottom">productos</div>
        </a>
        <a href="../../includes/paging.php" class="favorites-box">
            <div class="favorites-box-top"></div>
            <div class="favorites-box-middle">
                <img src="../../images/heart-fill-panel.svg">
            </div>
            <div class="favorites-box-bottom"><?= $favorite_row ?> favoritos</div>
        </a>
    </div>
    <a href="../services/services.php" class="account-menu">
        <div>Servicios</div>
    </a>
    <a href="../services/services.php" class="account-menu" style="color: #333;">
        <div>Ayuda</div>
    </a>
    <a href="../services/services.php" class="account-menu style="color: #333;">
        <div>Buzón de sugerencias</div>
    </a>
    <a href="../services/services.php" class="account-menu" style="color: #333;">
        <div>Acerca de</div>
    </a>
    <a href="../../includes/logout.php?page=account" class="account-menu" style="color: red;">
        <img class="menu-icon" src="../../images/box-arrow-left2.svg">
        <div>Cerrar Sesión</div>
    </a>
    <?php include '../../includes/footer-image.php'; ?>
</body>
</html>

<script>

document.addEventListener('DOMContentLoaded', function() {

    let cantidad = 0;
    let subtotal = 0;
    const cartArray = JSON.parse(sessionStorage.getItem("carrito"));
    const innerDiv = document.querySelector('.inner-div');

    if (cartArray) {
        
        cartArray.forEach(elemento => {

        cantidad += elemento.productQuantity;
        subtotal += parseFloat(elemento.productQuantity*elemento.productPrice);
        });
    }

    const cartBoxMiddleText = document.querySelector('.cart-box-middle-text');
    cartBoxMiddleText.innerHTML = '$ ' + subtotal + '.00';

    const cartBoxMiddle = document.querySelector('.cart-box-bottom');
    cartBoxMiddle.innerHTML = cantidad + ' productos';
});  

</script>