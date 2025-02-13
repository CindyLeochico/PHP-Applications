<?php
include "controller/TaskController.php";

$controller = new TaskController();

$scriptName = dirname($_SERVER['SCRIPT_NAME']); 
$requestUri = str_replace($scriptName, '', $_SERVER['REQUEST_URI']); 
 
$request = explode("/", trim($requestUri, "/")); 
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($_SERVER["REQUEST_METHOD"] == "GET"){
   $controller->index();
   //echo "GET";
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST"){
    $controller->addTask($_POST['task']);
   //echo "POST";
}
elseif($_SERVER["REQUEST_METHOD"] == "PUT"){
     $controller->updateTask($_POST['id'],1);
     // echo "PUT";
}
elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
    $controller->deleteTask($_POST['id']);
    // echo "DELETE";
}
else{
    echo "Invalid request";
} 

?>