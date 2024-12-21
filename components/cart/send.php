<?php

include "../../includes/paths.php";
include $bp."head.php";
include $bp."user-validation.php";
include $bp."dbconnect.php";

?>

<body>
    <?php
        include $bp."mobile-detector.php";
        if (!$detect->isTablet() && !$detect->isMobile()) include $bp . "nav.php";
        include $bp."contact.php";
        include "../../dev/dev.php";
    ?>
    <div style="height: 100vh; width: 100%; display: flex; justify-content: center; align-items: center; background-color:rgb(31, 158, 84); color: white;">
    <div><h1>PEDIDO REALIZADO! c:</h1></div>
    
    </div>

</body>
</html>