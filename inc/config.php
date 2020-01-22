<?php
define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "shop");
define("ORDERS_LOG", "orders.log");
$basket = array();
//$_SESSION['basket'] = array();
$count = 0;
setlocale(LC_ALL,"Russian");
$connection = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
include_once "lib.php";
basketInit();