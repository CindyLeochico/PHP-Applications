<?php
class Task{
    private $conn;
    public $id;
    public $task;
    public $is_completed;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
       $query = "SELECT * FROM tasks";
       return $this->conn->query($query); 
    }

    public function create(){
        // "INSERT INTO tasks(task) VALUES('task')"
        $query = "INSERT INTO tasks(task) VALUES('" . $this->task . "')";

        return $this->conn->query($query); 
    }

    public function update($is_completed){
        $query = "UPDATE tasks SET is_completed = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $is_completed, $this->id);
        return $stmt->execute();
    }

    public function delete(){
        $query = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}