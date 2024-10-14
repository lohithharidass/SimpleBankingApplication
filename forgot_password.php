<?php
require 'config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $conn->real_escape_string($_POST['input']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the input is a valid email
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        // Query to find the user by email
        $sql = "SELECT * FROM users WHERE email='$input'";
    } else {
        // Otherwise assume it is a phone number and check for the phone number
        $sql = "SELECT * FROM users WHERE mobile_number='$input'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
                $update_sql = "UPDATE users SET password='$hashed_password' WHERE email='$input'";
            } else {
                $update_sql = "UPDATE users SET password='$hashed_password' WHERE mobile_number='$input'";
            }

            if ($conn->query($update_sql)) {
                echo "Password updated successfully! <a href='login.php'>Login here</a>";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Passwords do not match!";
        }
    } else {
        echo "No account found with that email or phone number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - HL Banking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f7;
        }
        .forgot-container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            background-color: #0077b6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #005f88;
        }
    </style>
</head>
<body>

<div class="forgot-container">
    <h2>Forgot Password</h2>
    <p>Enter your email or phone number, then reset your password.</p>
    <form method="POST">
        <input type="text" name="input" placeholder="Email or Phone Number" required><br>
        <input type="password" name="new_password" placeholder="New Password" required><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
        <button type="submit">Reset Password</button>
    </form>
</div>

</body>
</html>
