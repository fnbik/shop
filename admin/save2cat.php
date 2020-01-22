<?php
include_once  "../inc/config.php";
include_once  "../inc/lib.php";
$title = htmlspecialchars($_POST['title']);
$author = htmlspecialchars($_POST['author']);
$pubyear = htmlspecialchars($_POST['pubyear']);
$price = htmlspecialchars($_POST['price']);
$image = htmlspecialchars($_POST['image']);
if(!addItemToCatalog($title, $author, $pubyear, $price, $image))
    echo 'An error occurred while adding the item to the catalog.';
else
{
    header("Location: ../additemform.php");
    exit;
}
?>