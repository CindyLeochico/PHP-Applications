<?php 
session_start(); // Start the session to store error messages
include "partials/header.php"; 
include "partials/navigation.php";

// Initialize database connection
$conn = mysqli_connect("localhost", "root", "", "login"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // User exists, fetch user data
        $user = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            echo "<p>Login successful!</p>";
            // Redirect or set session variables here
            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['error_message'] = 'Incorrect password!';
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = 'User does not exist!';
        header("Location: login.php");
        exit;
    }
}

?>

<div class="container">
    <div>
     <?php 
    // Display error message if it exists
    if (isset($_SESSION['error_message'])) {
        echo '<p style="color: red; text-align:center;">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']); // Clear the message after displaying it
    }
    ?>
    </div>
    <form method="post">
        <h2 style="text-align:center;">Login</h2>

        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>       
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit">Submit</button>
    </form>

   
</div>

<?php 
include "partials/footer.php"; 
?>
