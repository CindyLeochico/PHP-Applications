<?php
public function getAllStudents() {
    $stmt = $this->conn->prepare("SELECT * FROM students");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>