 <?php

require 'config.php';

// Start the session
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Input validation
    if (!empty($fullname) && !empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Email already exists. Please use a different email.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $fullname, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['username'] = $fullname;
                echo "New record created successfully. You can now log in.";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Please fill all fields correctly.";
    }
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>AGRO MARKET PLACE - Sign Up</title>
   <link rel="stylesheet" href="user.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="welcome-text">
                <h2>Welcome to Agro Market</h2>
                <p>Join our community of farmers and buyers for the freshest agricultural products.</p>
            </div>
            <img src="images/fruits.avif" alt="Fresh Agricultural Products">
        </div>
        <div class="right-panel">
            <form class="signup-form" action="user.php" method="POST">
                <div class="form-header">
                    <h3>Create Account</h3>
                    <p>Fill in the form to get started</p>
                </div>

                <?php if(isset($error)): ?>
                    <div class="message error"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if(isset($success)): ?>
                    <div class="message success"><?php echo $success; ?></div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input 
                        type="text" 
                        id="fullname" 
                        name="fullname" 
                        placeholder="Enter your full name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Enter your email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Create a password"
                        required
                    >
                </div>

                <button type="submit" class="submit-btn">Sign Up</button>

                <div class="login-link">
                    <p>Already have an account? <a href="login.php">Log In</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>