<?php

$bp = "../../includes/";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";

$query = "SELECT * FROM departments";
$dataset = mysqli_query($Conn,$query);

mysqli_close($Conn);

?>

<body>
    <?php
        include $bp."mobile-detector.php";
        include $detect->isTablet() || $detect->isMobile() ? $bp . "nav2.php" : $bp . "nav.php";
        include $bp."contact.php";
        include "../../dev/dev.php";
    ?>
    
</body>
</html>