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
        
        <div style="height: 100vh; width: 100%; display: flex; gap: 10px; flex-direction: column; justify-content: center; align-items: center;">
            <div><h1>TICKET ENVIADO</h1></div>
            <div>Su pedido está en revisión.</div>
            <a href="../billboard/billboard.php" style="background-color: #e64747;
                        color: white;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding: 10px;
                        border-radius: 10px;
                        height: 70px;
                        width: auto;
                        font-size: 25px;
                        cursor: pointer;
                        margin-left: 10px;
                        margin-right: 10px;">
                <div>Regresar a la página</div>
            </a>
        </div>

     <?php } else if ($_GET['status'] == "failed") { ?>
        
        <div style="height: 100vh; width: 100vw; display: flex; justify-content: center; align-items: center; background-color:rgb(243, 99, 99); color: white;">
            <div><h1>ERROR AL SOLICITAR PEDIDO! c:</h1></div>
            <div>
                volver a intentar
            </div>
        </div>

    <?php } ?>


</body>
</html>