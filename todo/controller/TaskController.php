<?php
session_start();
include "model/Task.php";
include "config/Database.php";

class TaskController{
    private $taskModel;

    public function __construct(){
        $database = new Database();
        $db= $database->connect();
        $this->taskModel = new Task($db);
    }
    public function addTask($task){
       $this->taskModel->task = $task;
       $this->taskModel->create(); 
       $_SESSION['task_added'] = true;
       header("Location:".$_SERVER['PHP_SELF']);
       exit;
    }
    public function updateTask($id, $is_completed){
        $this->taskModel->id = $id;
        $this->taskModel->update($is_completed);
        $_SESSION['task_completed'] = true;
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function deleteTask($id){
        $this->taskModel->id = $id;
        $this->taskModel->delete();
        $_SESSION['task_deleted'] = true;
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function undoTask($id){
        $this->taskModel->id = $id;
        $this->taskModel->update(false);
        $_SESSION['task_undone'] = true;
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function index(){
        $tasks = $this->taskModel->read();
        // print_r($task);
        if($tasks->num_rows==0){
            // error
        }
        // show in view
        include "view/TaskView.php";
    }
}