<?php
include_once  "inc/lib.php";
include_once  "inc/config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Catalog</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/catalog-border.css";
</head>
<body>
        <?php
        require "Header.php";
        ?>

        <?
        require_once  "admin/secure/secure.inc.php";
        if(isset($_GET['logout']))
        {
            logOut();
        }
        ?>

    <div class="block-content">
        <div class="header-block-content">
            <p style="color:white;">Items in <a style="text-decoration: none; color:yellow;" href="cart.php">basket</a>: <?= count($_SESSION['basket_session']) - 1?></p>
            <?php


                $goods = selectAllItems();
                foreach ($goods as $item)
                {
            ?>
            <aside>
                <img src="<?='img/'.$item['image']?>">
                <h3>Title: <?=$item['title']?></h3>
                <h3>Author: <?=$item['author']?></h3>
                <p>Publication year: <?=$item['pubyear']?></p>
                <p>Price: <?=$item['price']?> rub</p>
                <p><a href="add2basket.php?id=<?=$item['id']?>">To cart</a></p>
            </aside>
            <?php
                }
            ?>
        </div>
    </div>

    <?php
        require "Footer.php";
    ?>
</body>
</html>