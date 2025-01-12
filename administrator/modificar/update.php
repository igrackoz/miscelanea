<?php

require "../../includes/dbconnect.php";

$query = "UPDATE products SET ";

if (isset($_POST['product_code'])) {
    $query .= "product_code = '".$_POST['product_code']."', ";
}if (isset($_POST['product_description'])) {
    $query .= "product_description = '".$_POST['product_description']."', ";
}if (isset($_POST['product_type'])) {
    $query .= "product_type = '".$_POST['product_type']."', ";
}
if (isset($_POST['product_cost'])) {
    $query .= "product_cost = '".$_POST['product_cost']."', ";
}if (isset($_POST['product_price'])) {
    $query .= "product_price = '".$_POST['product_price']."', ";
}
if (isset($_POST['product_stock'])) {
    $query .= "product_stock = '".$_POST['product_stock']."', ";
}if (isset($_POST['product_minimum'])) {
    $query .= "product_minimum = '".$_POST['product_minimum']."', ";
}if (isset($_POST['product_maximum'])) {
    $query .= "product_maximum = '".$_POST['product_maximum']."', ";
}

$query = rtrim($query, ", ");

$query .= " WHERE product_id = '".$_POST['product_id']."'";

echo $query;

$dataset = mysqli_query($Conn, $query);

header("Location:modificar.php?id=".$_POST['product_id']."&item=updated");
exit();