<?php

echo "Hello World!";

$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM usuarios");

echo json_encode($usuarios);
class Sql extends PDO {
    
    private $conn;
    
    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=vendetd_php7", "vendetd_php7", "XpNhPkLfy(Qf");
    }
    
    private function setParams($statement, $parameters = array()) {
        
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }        
        
    }
    
    private function setParam($statement, $key, $value) {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array()) {
        $stmt = $this->conn->prepare($rawQuery);
        
        $this->setParams($stmt, $params);
        
        $stmt->execute();
        return $stmt;
        

    }
    
    public function select($rawQuery, $params = array()):array {
        $stmt = $this->query($rawQuery, $params);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
}