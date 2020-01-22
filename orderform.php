<?php
require "inc/lib.php";
require "inc/config.php";
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



<div class="main-content">
    <form action="saveorder.php" method="post">
        <p style="color:white;">Name: <input type="text" name="name" size="50">
        <p style="color:white;">Email: <input type="text" name="email" size="50">
        <p style="color:white;">Telephone: <input type="text" name="phone" size="4">
        <p style="color:white;">Delivery address: <input type="text" name="address" size="6">
        <p><input type="submit" value="To order">
    </form>
</div>

<?php
require "Footer.php";
?>
</body>
</html>