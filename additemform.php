<!DOCTYPE html>
<html>
<head>
    <title>Item add</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <?php
    require "Header.php";
    ?>

    <div class="main-content">
        <form action="admin/save2cat.php" method="post">
            <p style="color:white;">Name: <input type="text" name="title" size="50">
            <p style="color:white;">Author: <input type="text" name="author" size="50">
            <p style="color:white;">Publishing year: <input type="text" name="pubyear" size="4">
            <p style="color:white;">Price: <input type="text" name="price" size="6"> rub.
            <p style="color:white;"><input type="file" name="image" multiple accept="image/*,image/jpeg">
            <p><input type="submit" value="Add">
        </form>
    </div>

    <?php
    require "Footer.php";
    ?>
</body>
</html>