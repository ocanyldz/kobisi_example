<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../classes/db/dbClass.php';
include_once '../classes/customers.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$customers = new Customers($connection);

switch ($_GET['param']) {
    case 'day':
        $condition = 'DATE_FORMAT(S.sale_date, "%Y-%m-%d") = "2020-07-23"';
        break;
    case 'week':
        $condition = 'YEARWEEK(S.sale_date,1) = YEARWEEK("2020-07-23",1)';
        break;
    case 'month':
        $condition = 'YEAR(S.sale_date)=YEAR("2020-07-23") AND MONTH(S.sale_date) = MONTH("2020-07-23")';
        break;
}
$query = 'SELECT C.id, C.name, C.surname, TRUNCATE(SUM(S.amount), 2) AS total
        FROM customers C INNER JOIN sales S ON C.id=S.customer_id WHERE '.$condition.
        ' GROUP BY C.id ORDER BY total DESC LIMIT 10';

$stmt = $customers->fetch($query);
$count = $stmt->rowCount();

if($count > 0){
    $customers = array();
    $customers["body"] = array();
    $customers["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $p  = array(
            "id" => $id,
            "name" => $name,
            "surname" => $surname,
            "total" => $total
        );

        array_push($customers["body"], $p);
    }
    echo json_encode($customers);
}
else {
    $arr = array ("body"=>array(),"count"=>0);
    echo json_encode($arr);
}
?>