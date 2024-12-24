<?php

$bp = "../../includes/";
include $bp."head.php";
include $bp."user-validation.php";
include $bp."dbconnect.php";

?>

<body>
    <?php
        include $bp."mobile-detector.php";
        if (!$detect->isTablet() && !$detect->isMobile()) include $bp."nav.php";
        include "../../dev/dev.php";
    ?>

    <?php if ($_GET['status'] == "success") { ?>
        
        <div style="height: 100vh; width: 100%; display: flex; justify-content: center; align-items: center; background-color:rgb(31, 158, 84); color: white;">
            <div><h1>PEDIDO REALIZADO! c:</h1></div>
        </div>

     <?php } else if ($_GET['status'] == "failed") { ?>
        
        <div style="height: 100vh; width: 100%; display: flex; justify-content: center; align-items: center; background-color:rgb(243, 99, 99); color: white;">
            <div><h1>ERROR AL SOLICITAR PEDIDO! c:</h1></div>
            <div>
                volver a intentar
            </div>
        </div>

    <?php } ?>


</body>
</html>