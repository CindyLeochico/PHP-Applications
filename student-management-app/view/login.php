<?php
session_start();
require_once '../config/Database.php'; // Adjust the path as needed

$database = new Database();
$conn = $database->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start a session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: dashboard.php"); // Redirect to the dashboard
        exit();
    } else {
        $error = "Invalid email or password.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../public/style-new.css"> 

</head>
<body>
   
    
    <form method="post" action="">
         <h2>Login</h2>
        <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button class="button" type="submit">Login</button>
    </form>
</body>
</html>