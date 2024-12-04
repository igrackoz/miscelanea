<?php

include "../../includes/head.php";

session_start();

if(isset($_SESSION['nombre']) && isset($_SESSION['apellido'])){
    
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
} else { }

include "../../includes/dbconnect.php";

$query = "SELECT * FROM departments";
$dataset = mysqli_query($Conn,$query);

mysqli_close($Conn);

?>

<body>
    <?php include "../../includes/nav.php"; ?>
    <?php include "../../includes/contact.php"; ?>
</body>
</html>