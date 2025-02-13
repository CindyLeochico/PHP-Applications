<?php
class Database{
    private $host = "localhost";
    private $db_name = "todofs2";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect(){
        $this -> conn = new mysqli(
                $this->host, 
                $this->username, 
                $this->password, 
                $this->db_name);

        return $this->conn;        
    }
}