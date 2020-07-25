<?php
class Sales{

    private $connection;

    private $table_name = "sales";

    public $id;
    public $customer_id;
    public $product_id;
    public $sale_date;
    public $amount;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function fetch($query){ 

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}