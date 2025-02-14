<?php
session_start();
require_once '../config/Database.php'; // Adjust the path if needed

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$conn = $database->connect();

// Handle Add/Edit Student
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $student_email = $_POST['student_email'];

    if (isset($_POST['student_id']) && !empty($_POST['student_id'])) {
        // Update existing student
        $student_id = $_POST['student_id'];
        $stmt = $conn->prepare("UPDATE students SET name = :name, email = :email WHERE id = :id");
        $stmt->bindParam(':id', $student_id);
    } else {
        // Insert new student
        $stmt = $conn->prepare("INSERT INTO students (name, email) VALUES (:name, :email)");
    }

    $stmt->bindParam(':name', $student_name);
    $stmt->bindParam(':email', $student_email);

    if ($stmt->execute()) {
        $success = isset($student_id) ? "Student updated successfully." : "Student added successfully.";
    } else {
        $error = "Error saving student data.";
    }

    // Redirect to avoid form resubmission
    header("Location: dashboard.php");
    exit();
}

// Handle Delete Student
if (isset($_GET['delete'])) {
    $student_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM students WHERE id = :id");
    $stmt->bindParam(':id', $student_id);
    $stmt->execute();
    header("Location: dashboard.php");
    exit();
}

// Fetch all students
$stmt = $conn->prepare("SELECT * FROM students ORDER BY id DESC");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/style-new.css"> 
</head>
<body>
   
    <div class="dashboard-container">
        <div class="welcome-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h2>
     
</div>
        <div class="logout-container">
      
        <a href="logout.php" class="button">Logout</a>
</div>
       
 
        <!-- Student Form -->
        <?php
        if (isset($_GET['edit'])) {
            $student_id = $_GET['edit'];
            $stmt = $conn->prepare("SELECT * FROM students WHERE id = :id");
            $stmt->bindParam(':id', $student_id);
            $stmt->execute();
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        ?>
        <form method="post" action="">
            <input type="hidden" name="student_id" value="<?php echo isset($student['id']) ? $student['id'] : ''; ?>">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required value="<?php echo isset($student['name']) ? htmlspecialchars($student['name']) : ''; ?>">
            
            <label for="student_email">Student Email:</label>
            <input type="email" id="student_email" name="student_email" required value="<?php echo isset($student['email']) ? htmlspecialchars($student['email']) : ''; ?>">
            
            <button type="submit" class="button"><?php echo isset($_GET['edit']) ? "Update" : "Add"; ?> Student</button>
        </form>

        <!-- Student List -->
        <h3>Student List</h3>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Student Email</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td>2025-<?php echo htmlspecialchars($student['id']); ?></td>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                    <td>
                        <a href="dashboard.php?edit=<?php echo $student['id']; ?>" >Edit</a>
                        <a href="dashboard.php?delete=<?php echo $student['id']; ?>"  onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        
    </div>
</body>
</html>
