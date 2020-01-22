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
    <link rel="stylesheet" type="text/css" href="style/orderhistory-border.css">
</head>
<body>
<?php
require "Header.php";
?>



<div class="block-content">
    <div class="header-block-content">
        <table width="850px" border="2px solid yellow" style="margin-left: -23px;">
            <thead >
                <tr style="color: whitesmoke; align-content: center; align-items: center;text-align: center;">
                    <td>Client</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>OrderID</td>
                    <td>Date</td>
                </tr>
            </thead>
            <?php
                $orders = getOrders();
                if(gettype($orders) != boolean)
                {
                    foreach ($orders as $order)
                    {
                        echo '<tr style="text-align: center;">';
                        echo '<td style="color: navajowhite;">'.$order["name"].'</td>';
                        echo '<td style="color: navajowhite;">'.$order["email"].'</td>';
                        echo '<td style="color: navajowhite;">'.$order["phone"].'</td>';
                        echo '<td style="color: navajowhite;">'.$order["orderid"].'</td>';
                        echo '<td style="color: navajowhite;">'.$order["date"].'</td>';
                        echo '</tr>';
                    }

                }
            ?>
        </table>
    </div>
</div>

<?php
require "Footer.php";
?>
</body>
</html>