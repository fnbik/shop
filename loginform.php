<?php
$title = 'Authorization';
$login  = '';
session_start();
header("HTTP/1.0 401 Unauthorized");
require_once "admin/secure/secure.inc.php";
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $login = trim(strip_tags($_POST["login"]));
    $pw = trim(strip_tags($_POST["pw"]));
    $ref = trim(strip_tags($_GET["ref"]));

    if(!$ref)
        $ref = '/';
    if($login and $pw)
    {
        if($result = userExists($login))
        {
            list($_, $hash) = explode(':', $result);
            if(checkHash($pw, $hash))
            {
                $_SESSION['admin'] = true;
                header("Location: $ref");
                exit;
            }
            else
            {
                $title = "Wrong username or password";
            }
        }
        else
        {
            $title = "Wron username or password";
        }
    }
    else
    {
        $title = "Fill in all form fields";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Saving order data</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/login-border.css">
</head>
<body>
<?php
require "Header.php";
?>



<div class="main-content">
    <h4><?= $title?></h4>
    <form action="<?= $_SERVER['REQUEST_URI']?>" method="post">
        <div>
            <label for="txtUser" style="color:white;">Login</label>
            <input id="txtUser" type="text" name="login" value="<?= $login?>" />
        </div>
        <div>
            <label for="txtString" style="color:white;">Password</label>
            <input id="txtString" type="password" name="pw" />
        </div>
        <div>
            <button type="submit">login</button>
        </div>
    </form>
</div>

<?php
require "Footer.php";
?>
</body>
</html>