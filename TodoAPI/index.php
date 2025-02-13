<?php
include "controller/TaskController.php";
session_start();

$controller = new TaskController();

$scriptName = dirname($_SERVER['SCRIPT_NAME']); 
$requestUri = str_replace($scriptName, '', $_SERVER['REQUEST_URI']); 
 
$request = explode("/", trim($requestUri, "/")); 
$requestMethod = $_SERVER['REQUEST_METHOD'];

// GET  /                ----> get all tasks
// POST /task            ----> add a new task
// PUT /task/1           ----> mark task 1 as complete
//   {"is_completed": 1}
// PUT /task/1            ----> mark task 1 as incomplete
//   {"is_completed": 0}
// DELETE /task/1         ----> delete task 1
if($_SERVER["REQUEST_METHOD"] === "GET"){
    // echo "GET";
    $controller-> index();
    // echo $_SERVER['SCRIPT_NAME'];
    // echo "\n";
    // echo $scriptName;
    // echo "\n";
    // echo $_SERVER['REQUEST_URI'];
    // echo "\n";
    // echo $requestUri;
    // echo "\n";
    // echo $request[1];

}elseif($_SERVER["REQUEST_METHOD"] === "POST"){
    // echo "POST";
    $controller->addTask();
}elseif($_SERVER["REQUEST_METHOD"] === "PUT"){
    // echo "PUT";
    $controller->updateTask($request[1]);
}elseif($_SERVER["REQUEST_METHOD"] === "DELETE"){
    echo "DELETE";
    // $controller->deleteTask();
}else{
    echo "ELSE";
    // $controller-> index();
}
