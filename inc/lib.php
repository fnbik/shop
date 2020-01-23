<?
function addItemToCatalog($title, $author, $pubyear, $price, $image)
{
    global $connection;
	$sql = "INSERT INTO catalog (`id`, `title`, `author`, `pubyear`, `price`, `image`) VALUES (NULL, '$title', '$author', '$pubyear', '$price', '$image');";
	mysqli_query($connection, $sql);
	mysqli_close($connection);
    return true;
}
function selectAllItems()
{
    global $connection;
    $sql = "SELECT * FROM catalog";
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
    setcookie('basket', $_SESSION['basket_session'], time() + 3600);
}
function basketInit()
{
    if(!isset($_COOKIE['basket']))
    {
        $_SESSION['basket_session'] = array('orderid' => uniqid());
        saveBasket();
    }
    else
    {
        $_SESSION['basket_session'] = unserialize(base64_decode($_COOKIE['basket']));
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
    $sql = "SELECT * FROM catalog WHERE id IN($ids)";
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
    $sql = 'INSERT INTO orders (`title`, `author`, `pubyear`, `price`, `quantity`, `orderid`, `datetime`) VALUES(?, ?, ?, ?, ?, ?, ?)';
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



    if(!isset($_COOKIE['basket']))
        setcookie('basket', $_SESSION['basket_session'], time() - 3600);
    return true;
}
function getOrders()
{
    global $connection;
    if(!is_file("admin/".ORDERS_LOG))
        return false;

    $orders = file("admin/".ORDERS_LOG);
    $allorders = array();
    foreach ($orders as $order)
    {
        list($name, $email, $phone, $address, $orderid, $date) = explode("|", $order);
        $orderinfo = array();
        $orderinfo["name"] = $name;
        $orderinfo["email"] = $email;
        $orderinfo["phone"] = $phone;
        $orderinfo["orderid"] = $orderid;
        $orderinfo["date"] = $date;
        $sql = "SELECT title, author, pubyear, price, quantity FROM orders WHERE orderid = '$orderid'";
        if(!$result = mysqli_query($connection, $sql))
        {
            return false;
        }
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        $orderinfo["goods"] = $items;
        $allorders[] = $orderinfo;
    }
    return $allorders;
}