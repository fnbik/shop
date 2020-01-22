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
    global $basket;
    $basket = base64_encode(serialize($basket));
    setcookie('basket', $basket, 0x7FFFFFFF);
}
function basketInit()
{
    global $basket, $count;
    if(!isset($_COOKIE['basket']))
    {
        $basket = array('orderid' => uniqid());
        saveBasket();
    }
    else
    {
        $basket = unserialize(base64_decode($_COOKIE['basket']));
        $count = count($basket) - 1;
    }
}
function add2Basket($id)
{
    global $basket;
    $basket[$id] = 1;
    saveBasket();
}
function myBasket()
{
    global $connection, $basket;
    $goods = array_keys($basket);
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
    global $basket;
    $arr = array();
    while($row = mysqli_fetch_assoc($data))
    {
        $row['quantity'] = $basket[$row['id']];
        $arr[] = $row;
    }
    return $arr;
}
function deleteItemFromBasket($id)
{
    global $basket;
    unset($basket[$id]);
    saveBasket();
}
function saveOrder($datetime)
{
    global $connection, $basket;
    $goods = myBasket();
    $sql = "INSERT INTO `shop`.`orders` ('id', 'title', 'author', 'pubyear', 'price', 'quantity', 'orderid', 'datetime')";
}