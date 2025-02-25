<?php
include "controller/BookController.php";
session_start();

$controller = new TaskController();

$scriptName = dirname($_SERVER['SCRIPT_NAME']); 
$requestUri = str_replace($scriptName, '', $_SERVER['REQUEST_URI']); 
 
$request = explode("/", trim($requestUri, "/")); 
$requestMethod = $_SERVER['REQUEST_METHOD'];


if($_SERVER["REQUEST_METHOD"] === "GET"){
   
    $controller-> index();
  
}elseif($_SERVER["REQUEST_METHOD"] === "POST"){
    // echo "POST";
    $controller->addBook();
}elseif($_SERVER["REQUEST_METHOD"] === "PUT"){
    // echo "PUT";
    $controller->updateTask($request[1]);
}elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if (isset($request[1]) && is_numeric($request[1])) {
        $controller->deleteTask(intval($request[1]));  // ✅ Pass Task ID
    } else {
        echo json_encode(["error" => "Task ID is missing or invalid"]);
        exit;
    }

}else{
    echo "ELSE";
    // $controller-> index();
}
