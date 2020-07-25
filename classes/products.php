<?php
class Products{

    private $connection;

    private $table_name = "products";

    public $id;
    public $name;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function fetch($query){
        
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}