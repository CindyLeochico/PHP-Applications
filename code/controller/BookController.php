<?php
include "model/Task.php";
include "config/Database.php";

class TaskController {
    private $bookModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->bookModel = new Task($db);
    }

    public function addBook() {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        $this->bookModel->title = $data['title'];
        $this->bookModel->author = $data['author'];
        $this->bookModel->description = $data['description'];
        $result = $this->bookModel->create();
        
        if ($result) {
            echo json_encode(["title" => $data["title"], "author" => $data["author"], "description" => $data["description"]]);
        } else {
            echo json_encode(["message" => "Book not added"]);
        }
    }

    public function index() {
        $books = $this->bookModel->read();
       
        if ($books->num_rows == 0) {
            // error
            echo json_encode(["message" => "No book found"]);
        } else {
            $data = $books->fetch_all(MYSQLI_ASSOC);
            $jsonData = json_encode($data);
            echo $jsonData;
        }
    }
}