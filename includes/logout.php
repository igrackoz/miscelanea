<?php

$page = $_GET['page'];

session_start();
session_destroy();

if($page == "account"){
    header("Location: ../components/billboard/billboard.php");
    exit();
} else {
    header("Location: ../components/".$page."/".$page.".php");
    exit();    
}
?>