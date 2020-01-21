<?php
include_once  "inc/lib.php";
include_once  "inc/config.php";
deleteItemFromBasket($_GET['id']);
header("Location: cart.php");
?>