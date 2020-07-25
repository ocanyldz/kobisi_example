<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../classes/db/dbClass.php';
include_once '../classes/sales.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$sales = new Sales($connection);

$query = 'SELECT COUNT(S.id) AS sale_count FROM sales S
        WHERE DATE_FORMAT(S.sale_date, "%Y-%m-%d") = "2020-07-23"';

$stmt = $sales->fetch($query);
$count = $stmt->rowCount();

if($count > 0){
    $sales = array();
    $sales["body"] = array();
    $sales["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $p  = array(
            "sale_count" => $sale_count
        );

        array_push($sales["body"], $p);
    }
    echo json_encode($sales);
}
else {
    $arr = array ("body"=>array(),"count"=>0);
    echo json_encode($arr);
}
?>