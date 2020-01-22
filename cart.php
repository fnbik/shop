<?php
include_once  "inc/lib.php";
include_once  "inc/config.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link rel="stylesheet" type="text/css" href="style/cart-border.css">
    </head>
<body>
    <?php
    require "Header.php";
    ?>

    <?php
    global $count;
    if($count < 1)
        echo "<h4>Cart is empty! <a href='index.php'>Return to the catalog.</a></h4>";
    else
    {
        echo "<h4>User cart.</h4>";
        echo "<h4><a href='index.php'>Return to the catalog.</a></h4>";
    }
    $items = myBasket();
    $i = 1;
    $sum = 0;
    ?>
    <div class="block-content">
        <div class="header-block-content">
            <p style="color:white;">Items in <a style="text-decoration: none; color:yellow;" href="cart.php">basket</a>: <?= $count?></p>
            <?php
            if($count > 0):
            $goods = selectAllItems();
            foreach ($items as $item)
            {
                $sum += (int)$item['price'];
                ++$i;
                ?>
                <aside>
                    <img src="<?='img/'.$item['image']?>">
                    <h3>Title: <?=$item['title']?></h3>
                    <h3>Author: <?=$item['author']?></h3>
                    <p>Publication year: <?=$item['pubyear']?></p>
                    <p>Price: <?=$item['price']?></p>
                    <p><a href="delete_from_basket.php?id=<?=$item['id']?>">Delete</a></p>
                </aside>
                <?php
            }
            echo "<h4>Sum = $sum rub</h4>";



            echo '<div align="center">';
            echo    '<input type="button" value="Checkout!"';
            echo           "onClick=\"location.href='orderform.php'\" />";
            endif;
            ?>
            </div>
        </div>
    </div>

    <?php
    require "Footer.php";
    ?>
</body>
</html>
