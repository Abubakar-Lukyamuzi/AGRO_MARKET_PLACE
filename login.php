<?php
require 'config.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE fullname = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, log the user in
            $_SESSION['username'] = $username; // Store username in session
            header("Location: home.php"); // Redirect to a dashboard or home page
            exit();
        } else {
            // Password is incorrect
            echo '<script> alert("wrong password");</script>';
        }
    } else {
        // User does not exist, redirect to sign up page
        echo '<script> alert("user doesnt exist ");</script>';
        header("Location: user.php");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h2>Login to Your Account</h2>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="button">Login</button>
        </form>
        <p class="message">Don't have an account? <a href="user.php">Sign up here</a></p>
    </div>
    <script>
    //  event listener to the form to prevent default submission
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            // Validating form data before submission
            if (document.getElementById('username').value.trim() === '' || document.getElementById('password').value.trim() === '') {
                event.preventDefault();
                alert('Please fill in all fields.');
            }
        });
    </script>
</body>
</html>
           