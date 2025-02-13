<?php
include "model/Task.php";
include "config/Database.php";
session_start();

class TaskController{
    private $taskModel;

    public function __construct(){
        $database = new Database();
        $db= $database->connect();
        $this->taskModel = new Task($db);
    }
    public function addTask($task){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        $this->taskModel->task = $data['task'];
        $result = $this->taskModel->create();
        if($result){
            echo  json_encode(["task"=>"Task added"]);
      
         echo $jsonData;
    }
}
    public function updateTask($id, $is_completed){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        $this->taskModel->id = $id;
    $result =  $this->taskModel->update($data['is_completed']);
        if($is_completed){
            $_SESSION['message'] = "<span style='color: green;'> Task completed</span>";
        }else{
            $_SESSION['message'] = "<span style='color: red;'>Task marked as incomplete</span>"  ;    }
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function deleteTask($id){
        $this->taskModel->id = $id;
        $this->taskModel->delete();
        $_SESSION['message'] = "<span style='color: red;'>Task deleted</span>" ;  
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function index(){
        $tasks = $this->taskModel->read();
        // print_r($task);
        if($tasks->num_rows==0){
            // error
            echo json_encode(["message"=>"No tasks found"]);
        }
        else{
            $data=$tasks->fetch_all(MYSQLI_ASSOC);
            $jsonData=json_encode($data);
            echo $jsonData;
        }
       
    }
}