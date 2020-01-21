<?php
include_once  "inc/lib.php";
include_once  "inc/config.php";
add2Basket($_GET['id']);
header("Location: index.php");
?>