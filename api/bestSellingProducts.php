<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../classes/db/dbClass.php';
include_once '../classes/products.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$products = new Products($connection);

$query = 'SELECT P.id,P.name, COUNT(S.id) AS sale_count
            FROM products P
            INNER JOIN sales S ON P.id=S.product_id
            GROUP BY P.id
            ORDER BY sale_count DESC
            LIMIT 10';

$stmt = $products->fetch($query);
$count = $stmt->rowCount();

if($count > 0){
    $products = array();
    $products["body"] = array();
    $products["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $p  = array(
            "id" => $id,
            "name" => $name,
            "sale_count" => $sale_count
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