<?php
include_once  "inc/lib.php";
include_once  "inc/config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Saving order data</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <?php
    require "Header.php";
    ?>



    <div class="block-content">
        <div class="header-block-content">
            <p style="color:white; font-size: 24px;">Your order is accepted.</p>
            <p style="color:white; font-size: 24px;"><a href="index.php">Return to product catalog</a></p>
            <?php

                $order_date = date('d.m.Y H:i');
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $order = $name . ' | ' . $email . ' | ' . $phone . ' | ' . $address . ' | ' . $_SESSION['basket_session']['orderid'] . ' | ' . $order_date;
                saveOrder($order_date);
                $f = fopen("admin/".ORDERS_LOG, 'a');
                fwrite($f,$order . "\r\n");
                fclose($f);
            ?>
        </div>
    </div>

    <?php
    require "Footer.php";
    ?>
</body>
</html>