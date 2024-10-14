<?php
require 'config.php';
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables and redirect to MPIN verification
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: verify_mpin.php');
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Invalid username!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Login</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        /* Center the form */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('tech.jpeg'); 
            background-size: cover;
            background-position: center;
        }

        /* Form styling */
        .login-form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .login-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-form button {
            background-color: #0077b6;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .login-form button:hover {
            background-color: #005f88;
        }

        .login-form a {
            display: block;
            margin-top: 15px;
            color: #0077b6;
            text-decoration: none;
        }

        .login-form a:hover {
            text-decoration: underline;
        }

        /* Error message styling */
        .error-msg {
            color: red;
            margin: 10px 0;
        }

        /* Bank logo styling */
        .bank-logo {
            margin-bottom: 20px;
        }

        .bank-logo img {
            width: 150px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <form class="login-form" method="POST">
        <div class="bank-logo">
            <img src="bank-logo.png" alt="Bank Logo">
        </div>
        <h2>HS Bank</h2>
        <h2>Login to Your Account</h2>
        <input type="text" name="username" placeholder="Enter your Username" required><br>
        <input type="password" name="password" placeholder="Enter your Password" required><br>
        <button type="submit">Login</button>
        <a href="register.php">Register here</a>
        <a href="forgot_password.php">Forgot Password?</a>
        <?php if (isset($error)): ?>
            <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
