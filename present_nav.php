<?php
$main_con_nav =
    array(
        array("href" => "index.php", "content" => "products"),
        array("href" => "cart.php", "content" => "cart"),
        array("href" => "order_history.php", "content" => "order history"),
        array("href" => "additemform.php", "content" => "add item to catalog"),
        array("href" => "createuserform.php", "content" => "create user"),
        array("href" => "loginform.php", "content" => "login")
    );
echo '<ul>';
for ($i = 0; $i < count($main_con_nav); ++$i)
    echo "<li><a href=" . $main_con_nav[$i]['href'] . ">". $main_con_nav[$i]['content']."</a></li>";
echo '</ul>';