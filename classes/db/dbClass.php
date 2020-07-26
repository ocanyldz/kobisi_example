<?php
class DBClass {

    private $host = "eu-cdbr-west-03.cleardb.net";
    private $username = "bce900106d9e20";
    private $password = "18e812ab";
    private $database = "heroku_b4e61e7b9943e64";

    public $connection;

    // get the database connection
    public function getConnection(){

        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
?>