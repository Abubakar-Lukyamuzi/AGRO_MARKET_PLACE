<?php
require 'config.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

$error_message = '';
$success_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error_message = "Please fill in all fields";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("SELECT id, password, fullname FROM users WHERE fullname = ?");
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
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['fullname'];
                $_SESSION['last_activity'] = time();
                
                $success_message = "Login successful! Redirecting...";
                header("refresh:1;url=home.php");
                exit();
            } else {
                $error_message = "Invalid password";
            }
        } else {
            $error_message = "User does not exist";
        }

        // Close the statement
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Agro Marketplace</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #27ae60;
            --primary-dark: #219653;
            --primary-light: #6fcf97;
            --accent-color: #f39c12;
            --text-color: #2d3436;
            --text-light: #636e72;
            --background-color: #f5f6fa;
            --card-color: #ffffff;
            --border-radius: 12px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --animation-duration: 0.3s;
        }

        [data-theme="dark"] {
            --primary-color: #2ecc71;
            --primary-dark: #27ae60;
            --primary-light: #55efc4;
            --accent-color: #f39c12;
            --text-color: #f5f6fa;
            --text-light: #dfe6e9;
            --background-color: #2d3436;
            --card-color: #1e272e;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--background-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color var(--animation-duration) ease;
            position: relative;
            overflow-x: hidden;
            padding: 20px;
        }

        .background-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: var(--primary-light);
            opacity: 0.1;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -150px;
            animation: float 8s infinite ease-in-out;
        }

        .circle-2 {
            width: 500px;
            height: 500px;
            bottom: -250px;
            right: -250px;
            animation: float 10s infinite ease-in-out reverse;
        }

        .circle-3 {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 10%;
            animation: float 12s infinite ease-in-out 2s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(2%, 2%) rotate(5deg);
            }
            50% {
                transform: translate(0, 5%) rotate(0deg);
            }
            75% {
                transform: translate(-2%, 2%) rotate(-5deg);
            }
            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            margin: auto;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            min-height: 550px;
            background: var(--card-color);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-illustration {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .login-illustration::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            top: -50%;
            left: -50%;
            transform: rotate(30deg);
        }

        .illustration-content {
            text-align: center;
            color: white;
            z-index: 2;
            padding: 1rem;
        }

        .illustration-content h1 {
            font-size: 2.2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .illustration-content p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .illustration-image {
            width: 100%;
            max-width: 260px;
            margin-bottom: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .login-form-container {
            flex: 1;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--card-color);
            border: none;
            color: var(--text-color);
            font-size: 1.3rem;
            cursor: pointer;
            z-index: 100;
            transition: transform var(--animation-duration) ease;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .theme-toggle:hover {
            transform: rotate(30deg);
        }

        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        h2 {
            color: var(--text-color);
            text-align: center;
            margin-bottom: 0.5rem;
            font-size: 2rem;
            font-weight: 600;
        }

        .subtitle {
            color: var(--text-light);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            transition: color var(--animation-duration) ease;
        }

        .form-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: all var(--animation-duration) ease;
            background-color: var(--card-color);
            color: var(--text-color);
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.1);
        }

        .form-group input:focus + i {
            color: var(--primary-color);
        }

        .button {
            width: 100%;
            padding: 15px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all var(--animation-duration) ease;
            position: relative;
            overflow: hidden;
        }

        .button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .button:hover::after {
            transform: translateX(100%);
        }

        .button:disabled {
            background: var(--text-light);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .message {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .message a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color var(--animation-duration) ease;
            display: inline-block;
            padding: 5px 10px;
        }

        .message a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            text-align: center;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-error {
            background: #fde8e8;
            color: #e53e3e;
            border: 1px solid #fbd5d5;
        }

        .alert-success {
            background: #e8f8e8;
            color: #38a169;
            border: 1px solid #d5fbd5;
        }

        .loading {
            display: none;
            text-align: center;
            margin-top: 1rem;
        }

        .loading-spinner {
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color var(--animation-duration) ease;
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e0e0e0;
            background: var(--card-color);
            color: var(--text-color);
            transition: all var(--animation-duration) ease;
            cursor: pointer;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .social-btn.facebook {
            color: #3b5998;
        }

        .social-btn.google {
            color: #db4437;
        }

        .social-btn.twitter {
            color: #1da1f2;
        }

        .separator {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .separator span {
            padding: 0 10px;
        }

        .register-button {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 8px 16px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-left: 10px;
        }

        .register-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        @media (max-width: 992px) {
            .login-container {
                width: 90%;
                flex-direction: column;
                height: auto;
                max-height: 90vh;
            }

            .login-illustration {
                padding: 2rem;
                min-height: 300px;
            }

            .illustration-content h1 {
                font-size: 1.8rem;
            }

            .illustration-content p {
                font-size: 1rem;
            }

            .illustration-image {
                max-width: 200px;
            }

            .login-form-container {
                padding: 2rem;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }

            .login-container {
                width: 100%;
                margin: 0 auto;
                border-radius: 0;
                box-shadow: none;
            }

            .login-illustration {
                min-height: 200px;
                padding: 1rem;
            }

            .illustration-content h1 {
                font-size: 1.5rem;
            }

            .illustration-image {
                max-width: 150px;
                margin-bottom: 1rem;
            }

            .form-footer {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .theme-toggle {
                top: 10px;
                right: 10px;
            }
        }
    </style>
</head>
<body>
    <button id="themeToggle" class="theme-toggle">
        <i class="fas fa-moon"></i>
    </button>

    <div class="background-decoration">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
    </div>

    <div class="login-container">
        <div class="login-illustration">
            <div class="illustration-content">
                <h1>Welcome to Agro Marketplace</h1>
                <p>Connect with farmers, buy fresh produce, and support local agriculture.</p>
                <img src="https://img.freepik.com/free-photo/close-up-hands-holding-plants_23-2149142897.jpg?ga=GA1.1.1915270946.1736669883&semt=ais_hybrid&w=740" 
                     alt="Agriculture Illustration" class="illustration-image">
            </div>
        </div>

        <div class="login-form-container">
            <div class="logo">
                <img src="assets/images/logo.png" alt="Agro Marketplace Logo" onerror="this.src='https://cdn-icons-png.flaticon.com/512/1532/1532688.png'">
            </div>
            <h2>Welcome Back</h2>
            <p class="subtitle">Log in to access your account</p>
            
            <?php if ($error_message): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>

            <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                <div class="form-group">
                    <input type="text" id="username" name="username" placeholder="Username" required autofocus>
                    <i class="fas fa-user"></i>
                </div>

                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fas fa-lock"></i>
                </div>

                <div class="form-footer">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="button" id="loginButton">
                    <span>Login</span>
                </button>
            </form>

            <div class="separator">
                <span>Or continue with</span>
            </div>

            <div class="social-login">
                <a href="#" class="social-btn facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-btn google">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#" class="social-btn twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
            
            <p class="message">Don't have an account? <button onclick="window.location.href='user.php'" class="button register-button">Register Now</button></p>
        </div>
    </div>

    <script>
        // Theme toggle functionality - FIXED VERSION
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded');
            const themeToggle = document.getElementById('themeToggle');
            if (!themeToggle) {
                console.error('Theme toggle button not found');
                return;
            }
            
            const themeIcon = themeToggle.querySelector('i');
            
            // Check for saved theme preference or default to 'light'
            const savedTheme = localStorage.getItem('theme') || 'light';
            console.log('Saved theme:', savedTheme);
            
            // Apply theme on initial load
            setTheme(savedTheme);
            
            // Handle theme toggle click
            themeToggle.addEventListener('click', function() {
                console.log('Theme toggle clicked');
                const currentTheme = document.body.getAttribute('data-theme') || 'light';
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                setTheme(newTheme);
                
                // Save preference to localStorage
                localStorage.setItem('theme', newTheme);
            });
            
            // Function to set the theme
            function setTheme(theme) {
                console.log('Setting theme to:', theme);
                document.body.setAttribute('data-theme', theme);
                
                // Update theme icon
                if (theme === 'dark') {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                } else {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                }
            }
        });
        
        // Form submission handling
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            const loginButton = document.getElementById('loginButton');
            
            if (username === '' || password === '') {
                event.preventDefault();
                
                // Create shake animation
                const container = document.querySelector('.login-container');
                container.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    container.style.animation = '';
                }, 500);
                
                // Show error message
                const errorDiv = document.createElement('div');
                errorDiv.classList.add('alert', 'alert-error');
                errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> Please fill in all fields';
                
                // Remove existing error messages first
                document.querySelectorAll('.alert-error').forEach(el => el.remove());
                
                // Insert error before the form
                document.getElementById('loginForm').insertAdjacentElement('beforebegin', errorDiv);
                
                return;
            }
            
            // Show loading state
            loginButton.disabled = true;
            loginButton.innerHTML = '<div class="loading-spinner"></div>';
        });
        
        // Add subtle animation to form inputs
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-3px)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
        
        // Preload the illustration image
        const preloadImage = new Image();
        preloadImage.src = 'https://img.freepik.com/free-vector/organic-farming-concept-illustration_114360-8487.jpg';
    </script>
    
    <style>
        /* Shake animation */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        /* Dark mode styles */
        [data-theme="dark"] {
            --primary-color: #2ecc71;
            --primary-dark: #27ae60;
            --primary-light: #55efc4;
            --accent-color: #f39c12;
            --text-color: #f5f6fa !important;
            --text-light: #dfe6e9 !important;
            --background-color: #2d3436 !important;
            --card-color: #1e272e !important;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        [data-theme="dark"] body {
            background-color: #2d3436 !important;
            color: #f5f6fa !important;
        }
        
        [data-theme="dark"] .login-container {
            background-color: #1e272e !important;
            color: #f5f6fa !important;
        }
        
        [data-theme="dark"] h2,
        [data-theme="dark"] .subtitle,
        [data-theme="dark"] .message {
            color: #f5f6fa !important;
        }
        
        [data-theme="dark"] .form-group input {
            background-color: #1e272e !important;
            color: #f5f6fa !important;
            border-color: #4a5568 !important;
        }
        
        [data-theme="dark"] .social-btn {
            background-color: #1e272e !important;
            border-color: #4a5568 !important;
            color: #f5f6fa !important;
        }
        
        [data-theme="dark"] .theme-toggle {
            background-color: #4a5568 !important;
            color: #f5f6fa !important;
        }
        
        [data-theme="dark"] .separator::before,
        [data-theme="dark"] .separator::after {
            background-color: #4a5568 !important;
        }
        
        [data-theme="dark"] .separator span {
            color: #f5f6fa !important;
        }
    </style>
</body>
</html>
           