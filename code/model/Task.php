<?php
class Task{
    private $conn;
    public $id;
    public $title;
    public $author;
    public $description;
    

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
       $query = "SELECT * FROM books";
       return $this->conn->query($query); 
    }

    public function create(){
     
        $query = "INSERT INTO books (title, author, description) VALUES ('" . $this->title . "', '" . $this->author . "', '" . $this->description . "')";

        return $this->conn->query($query); 
    }

}