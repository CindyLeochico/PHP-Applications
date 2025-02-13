<?php
public function createStudent() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $student_id = $_POST["student_id"];
        $email = $_POST["email"];

        $studentModel = new StudentModel();
        $studentModel->addStudent($name, $student_id, $email);
    }
}

public function deleteStudent($id) {
    $studentModel = new StudentModel();
    $studentModel->removeStudent($id);
}
?>