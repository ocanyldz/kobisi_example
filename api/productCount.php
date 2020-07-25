<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../classes/db/dbClass.php';
include_once '../classes/products.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$products = new Products($connection);

$query = 'SELECT COUNT(id) AS product_count FROM products';

$stmt = $products->fetch($query);
$count = $stmt->rowCount();

if($count > 0){
    $products = array();
    $products["body"] = array(); 
    $products["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $p  = array(
            "product_count" => $product_count
        );

        array_push($products["body"], $p);
    }
    echo json_encode($products);
}
else {
    $arr = array ("body"=>array(),"count"=>0);
    echo json_encode($arr);
}
?>