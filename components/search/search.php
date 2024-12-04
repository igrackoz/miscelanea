<?php

include "../../includes/head.php";

session_start();

if(isset($_SESSION['nombre']) && isset($_SESSION['apellido'])){
    
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
} else { }

include "../../includes/dbconnect.php";
$query = "SELECT product_image, product_name, product_price FROM products";
$dataset = mysqli_query($Conn,$query);
mysqli_close($Conn);

?>

<body>
    <?php include "../../includes/nav.php"; ?>
    <?php include "../../includes/contact.php"; ?>
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