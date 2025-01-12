<?php 

$iddep = $_GET['iddep'];
$idsubdep = $_GET['idsubdep'];
$bp = "../../includes/";
include $bp."dbconnect.php";

$query = "SELECT product_id, product_description, product_image, product_cost, product_price, product_stock FROM products WHERE department_id = $iddep AND segment_id = $idsubdep";
$dataset = mysqli_query($Conn,$query);

mysqli_close($Conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    .div-interaction {
        transition: all 0.3s ease;
    }
    .div-interaction:hover {
        background-color: blue;
        border: 2px solid #222;
    }

    </style>
</head>
<body>
<div class="main-container" style="
	display: flex;
	justify-content: center;">
    <div style="
        display: flex;
        flex-wrap: wrap;
        align-items: start;
        gap: 10px;">

        <?php if (mysqli_num_rows($dataset) > 0) {while ($row = mysqli_fetch_assoc($dataset)) { ?>
            
            <div class="div-interaction" onclick="agregar(<?= $row['product_id'] . ',\'' . $row['product_description'] . '\',' . $row['product_price'] ?>,1)" style="
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                height: 200px;
                width: 200px;
                border: 2px solid darkgray;
                border-radius: 20px;
                background-color: lightgray;">
                <img src="../../images/departments/<?= $row['product_image'] ?>" style="height: 100px; width: 100px;">
                <div><?= $row['product_description'] ?></div>
                <div style="color: green;"><?= $row['product_price'] ?></div>
            </div>

        <?php }} ?>

    </div>
</div>
</body>
</html>

<script>

function agregar(productId,productDescription,productPrice,productQuantity) {

    let item = {
        id: productId,
        description: productDescription,
        price: productPrice,
        quantity: productQuantity
    };
    // Enviar los datos al contenedor
    window.parent.postMessage(item, '*');
}

</script>