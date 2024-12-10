<?php

include "../../includes/paths.php";
include $bp."head.php";
include $bp."user-validation.php";
include $bp."dbconnect.php";

$query = "SELECT product_image, product_name, product_price FROM products";
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

    <div style="height: 50px;"></div>
    <div style="font-size: 30px; font-weight: light;">Buscaste: <?= '"'.$_GET['cool-search'].'"' ?></div>
    <div style="height: 50px;"></div>
    <!--
    <div style="height: 100px;"></div>
    
    <div class="void d-flex align-items-start flex-column mb-3">
        <div class="section-name"><h3> &nbsp; CATÁLOGO </h3></div>
    </div>
-->
    <?php
/*
    if (mysqli_num_rows($dataset) > 0) {

        while ($row = mysqli_fetch_assoc($dataset)) { ?>

            <div class="card" style="width: 18rem; background-color: red; ">
                <table class="" style=" " width="200">
                    <tr>
                        <td>
                            <div class="fw-bold mx-3">
                                <img style="height: 150px; width: 150px;" src="../images/<?= $row['product_image'] ?>" alt="">
                            </div>
                        </td>
                        <td><p class="fw-bold fs-3"><?= $row['product_name']; ?></p></td>
                        <td><p class="fw-bold fs-3"><?= $row['product_price']; ?></p></td>
                    </tr>
                </table>
            </div>

        <?php } ?>
    <?php } */?>


    <div class="main-container">
        <div class="box-catalog">
            <div class="box-product">
            </div>
            <div class="box-product">
            </div>
            <div class="box-product">
            </div>
            <div class="box-product">
            </div>
            <div class="box-product">
            </div>
            <div class="box-product">
            </div>
            <div class="box-product">
            </div>
        </div>
    </div>

</body>
</html>