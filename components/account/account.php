<?php

include "../../includes/paths.php";
include $bp."head.php";
include $bp."user-validation.php";
include $bp."dbconnect.php";

$userid = $_GET['userid'];

$query2 = "SELECT * FROM users WHERE user_id = ".$userid;
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

    <div style="height: 150px; width: 100%; display: flex; align-items: center; justify-content: center;">
        <div>imagen</div>
        <div>nombre</div>
        <div>salir</div>
    </div>
    <div style="height: 100px;">artículos favoritos</div>
    <div style="height: 100px;">carrito</div>
</body>
</html>