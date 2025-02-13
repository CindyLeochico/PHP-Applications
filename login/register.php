<?php 
session_start(); // Start the session to store and display messages
include "partials/header.php"; 
include "partials/navigation.php";

// Initialize database connection
$conn = mysqli_connect("localhost", "root", "", "login");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password == $confirm_password) {
        // Check if username exists
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
             $_SESSION['error_message'] = 'User already exists!';
        header("Location: register.php");
        exit;
        } else {
            // Hash the password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL query to insert new user
            $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['correct_message'] = 'User registered successfully';
                header("Location: register.php");
                exit;
            } else {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }
        }
    } else {
        $_SESSION['error_message'] = 'Passwords do not match!';
        header("Location: register.php");
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
        } elseif (isset($_SESSION['correct_message'])) {
            echo '<p style="color: green; text-align:center;">' . $_SESSION['correct_message'] . '</p>';
            unset($_SESSION['correct_message']); // Clear the message after displaying it
        }
        ?>
    </div>

    <form method="post">
        <h2 class="register-heading">Register</h2>       
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
        </div>

        <button type="submit">Submit</button>
    </form>
</div>

<?php 
include "partials/footer.php"; 
?>
