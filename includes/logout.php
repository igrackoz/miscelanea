<?php

session_start();
session_destroy();
header("Location: ../components/billboard/billboard.php");
exit();
?>