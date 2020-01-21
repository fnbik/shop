<?php
include_once  "../inc/config.php";
include_once  "../inc/lib.php";
$title = $_POST['title'];
$author = $_POST['author'];
$pubyear = $_POST['pubyear'];
$price = $_POST['price'];
$image =$_POST['image'];
if(!addItemToCatalog($title, $author, $pubyear, $price, $image))
    echo 'An error occurred while adding the item to the catalog.';
else
{
    header("Location: ../additemform.php");
    exit;
}
?>