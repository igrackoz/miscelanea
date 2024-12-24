<?php

$bp = "../../includes/";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";

$userid = $_GET['userid'];

$query = "SELECT user_id, user_email, user_street, user_num_ext, user_phone FROM users WHERE user_id = ".$userid;
$dataset = mysqli_query($Conn,$query);
$row = mysqli_fetch_assoc($dataset);

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
            <div><?= $row['user_email'] ?></div>&nbsp;&nbsp;<img src="../../images/pencil.svg">
        </div>
        <div style="background-color: #ccc; height: 1px; width: 100%;"></div>
        <div class="address">
            <div><?= $row['user_street'].", #".$row['user_num_ext'] ?></div>&nbsp;&nbsp;<img src="../../images/pencil.svg">
        </div>
        <div style="background-color: #ccc; height: 1px; width: 100%;"></div>
        <div class="address">
            <div><?= $row['user_phone'] ?></div>&nbsp;&nbsp;<img src="../../images/pencil.svg">
        </div>
    </div>

    <div style="display: flex; border-radius: 10px; gap: 10px; padding: 20px; justify-content: center; align-items: start; color: white; background-color:rgb(17, 94, 194); width: auto; margin-left: 10px; margin-right: 10px; margin-top: 10px;">
        <img style="margin-top: 4px;" src="../../images/exclamation-circle.svg">
        <div>
            Sus datos de dirección serán usados con la finalidad de otorgar un servicio de entrega a domicilio óptimo y eficiente.
        </div>
    </div>

    <a href="../../components/cart/cart.php">
        <div class="cart-redirect red">
            <div class="inner-div">

            </div>
        </div>
    </a>
    <div style="height: 100px; display: flex; justify-content: center;">artículos favoritos</div>
    <div style="height: 100px;"></div>
    <div style="display: flex; justify-content: center; font-size: 20px;">
        Cerrar Sesión
    </div>
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

            
    const div1 = document.createElement('div');
    div1.style = 'font-size: 30px; color: white;';
    div1.innerHTML = 'Carrito de Compras';
    innerDiv.appendChild(div1);

    const div2 = document.createElement('div');
    div2.style.color = 'white';
    div2.innerHTML = cantidad + ' productos';
    innerDiv.appendChild(div2);

    const div3 = document.createElement('div');
    div3.style = 'font-size: 40px; right: 0; bottom: 0; color: white;';
    innerDiv.appendChild(div3);

    const strong = document.createElement('strong');
    strong.innerHTML = '$ ' + subtotal + '.00';
    div3.appendChild(strong);
});  

</script>