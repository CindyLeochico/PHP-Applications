<?php
include "model/Task.php";
include "config/Database.php";

class TaskController{
    private $taskModel;

    public function __construct(){
        $database = new Database();
        $db= $database->connect();
        $this->taskModel = new Task($db);
    }
    public function addTask(){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        $this->taskModel->task = $data['task'];
        $result = $this->taskModel->create(); 
        if($result){
          echo json_encode(["task"=>$data["task"]]);
        }else{
            echo json_encode(["message"=>"Task not added"]);
        }
    }
    public function updateTask($id){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        $this->taskModel->id = $id;
        $result = $this->taskModel->update($data['is_completed']);
        if($result){
            echo json_encode(["id"=>$id, "is_completed"=>$data["is_completed"]]);
          }else{
              echo json_encode(["message"=>"Task not updated"]);
          }
    }
    public function deleteTask($id){
        $this->taskModel->id = $id;
        $this->taskModel->delete();
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function index(){
        $tasks = $this->taskModel->read();
        // print_r($task);
        if($tasks->num_rows==0){
            // error
            echo json_encode(["message"=>"No tasks found"]);
        }else{
            $data = $tasks->fetch_all(MYSQLI_ASSOC);
            $jsonData = json_encode($data);
            echo $jsonData;
        }
    }
}