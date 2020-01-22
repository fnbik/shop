<?
function addItemToCatalog($title, $author, $pubyear, $price, $image)
{
    global $connection;
	$sql = "INSERT INTO `shop`.`catalog` (`id`, `title`, `author`, `pubyear`, `price`, `image`) VALUES (NULL, '$title', '$author', '$pubyear', '$price', '$image');";
	mysqli_query($connection, $sql);
	mysqli_close($connection);
    return true;
}
function selectAllItems()
{
    global $connection;
    $sql = "SELECT * FROM `shop`.`catalog`";
    if(!$result = mysqli_query($connection, $sql))
        return true;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($connection);
    return $items;
}
function saveBasket()
{
    $_SESSION['basket_session'] = base64_encode(serialize($_SESSION['basket_session']));
    setcookie('basket', $_SESSION['basket_session'], 0x7FFFFFFF);
}
function basketInit()
{
    global $count;
    if(!isset($_COOKIE['basket']))
    {
        $_SESSION['basket_session'] = array('orderid' => uniqid());
        saveBasket();
    }
    else
    {
        $_SESSION['basket_session'] = unserialize(base64_decode($_COOKIE['basket']));
        $count = count($_SESSION['basket_session']) - 1;
    }
}
function add2Basket($id)
{
    $_SESSION['basket_session'][$id] = 1;
    saveBasket();
}
function myBasket()
{
    global $connection;
    $goods = array_keys($_SESSION['basket_session']);
    array_shift($goods);
    if(!$goods)
        return false;
    $ids = implode(",", $goods);
    $sql = "SELECT * FROM `shop`.`catalog` WHERE id IN($ids)";
    if(!$result = mysqli_query($connection, $sql))
        return false;
    $items = result2Array($result);
    mysqli_free_result($result);
    return $items;
}
function result2Array($data)
{
    $arr = array();
    while($row = mysqli_fetch_assoc($data))
    {
        $row['quantity'] = $_SESSION['basket_session'][$row['id']];
        $arr[] = $row;
    }
    return $arr;
}
function deleteItemFromBasket($id)
{
    unset($_SESSION['basket_session'][$id]);
    saveBasket();
}
function saveOrder($datetime)
{
    global $connection;
    $goods = myBasket();
    $stmt = mysqli_stmt_init($connection);
    $sql = 'INSERT INTO `shop`.`orders` (`title`, `author`, `pubyear`, `price`, `quantity`, `orderid`, `datetime`) VALUES(?, ?, ?, ?, ?, ?, ?)';
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        echo mysqli_error($connection);
        return false;
    }
    foreach ($goods as $item)
    {
        mysqli_stmt_bind_param($stmt, "ssiiisi", $item['title'], $item['author'], $item['pubyear'], $item['price'], $item['quantity'], $_SESSION['basket_session']['orderid'], $datetime);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);

    unset($_COOKIE['basket']);
    return true;
}