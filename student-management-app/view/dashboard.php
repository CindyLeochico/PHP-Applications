<?php
session_start();
require_once '../config/Database.php'; // Adjust the path as needed

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$conn = $database->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $student_email = $_POST['student_email'];

    // Check if student name or email already exists
    $stmt = $conn->prepare("SELECT * FROM students WHERE name = :name OR email = :email");
    $stmt->bindParam(':name', $student_name);
    $stmt->bindParam(':email', $student_email);
    $stmt->execute();
    $existingStudent = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingStudent) {
        $error = "Student name or email already exists.";
    } else {
        // Insert the new student into the database
        $stmt = $conn->prepare("INSERT INTO students (name, email) VALUES (:name, :email)");
        $stmt->bindParam(':name', $student_name);
        $stmt->bindParam(':email', $student_email);

        if ($stmt->execute()) {
            $success = "Student added successfully.";
        } else {
            $error = "Error adding student.";
        }
    }
    // Redirect to the same page to avoid form resubmission
    header("Location: dashboard.php");
    exit();
}

// Fetch all students
$stmt = $conn->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/style.css"> 
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <h3>Add Student</h3>
        <?php if (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required>
            <br>
            <label for="student_email">Student Email:</label>
            <input type="email" id="student_email" name="student_email" required>
            <br>
            <button type="submit" class="button">Add Student</button>
        </form>
        <h3>Student List</h3>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Student Email</th>
            </tr>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td>2025-<?php echo htmlspecialchars($student['id']); ?></td>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>