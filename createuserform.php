<?php
require "admin/secure/session.inc.php";
require "admin/secure/secure.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Saving order data</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/useradd-border.css">
</head>
<body>
<?php
require "Header.php";
?>



<div class="main-content">
    <?
    $login = 'root';
    $password = '1234';
    $result = '';
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $login = $_POST['login'] ?: $login;
        if(!userExists($login)){
            $password = $_POST['password'] ?: $password;
            $hash = getHash($password);
            if(saveUser($login, $hash))
                $result = "<h4>".'The hash '. $hash. ' successfully added to the file'."</h4>";
            else
                $result = 'An error occurred while writing the '. $hash. ' hash';
        }else{
            $result = "<h4>"."User $login already exists. Choose a different name."."</h4>";
        }
    }
    ?>

    <h4><?= $result?></h4>
    <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <div>
            <label for="txtUser" style="color: white;">Login</label>
            <input id="txtUser" type="text" name="login" value="<?= $login?>" style="width:20em"/>
        </div>
        <div>
            <label for="txtString" style="color: white;">Password</label>
            <input id="txtString" type="text" name="password" value="<?= $password?>" style="width:20em"/>
        </div>
        <div>
            <button type="submit">Create</button>
        </div>
    </form>

</div>

<?php
require "Footer.php";
?>
</body>
</html>