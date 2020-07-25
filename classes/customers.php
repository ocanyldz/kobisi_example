<?php
class Customers{

    private $connection;

    private $table_name = "customers";

    public $id;
    public $name;
    public $surname;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function fetch($query){  

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}