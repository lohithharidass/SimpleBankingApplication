<?php
require 'config.php'; // Include database connection file
$success = false; // Flag to track successful registration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile_number = $conn->real_escape_string($_POST['mobile_number']);
    $account_id = $conn->real_escape_string($_POST['account_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $account_number = $conn->real_escape_string($_POST['account_number']);
    $account_type = $conn->real_escape_string($_POST['account_type']);
    $mpin = $conn->real_escape_string($_POST['mpin']);

    // Insert data into the database
    $sql = "INSERT INTO users (username, password, email, mobile_number, account_id, name, account_number, account_type, mpin) 
            VALUES ('$username', '$password', '$email', '$mobile_number', '$account_id', '$name', '$account_number', '$account_type', '$mpin')";
    
    if ($conn->query($sql)) {
        $success = true; // Registration is successful
    } else {
        echo "<p class='error-msg'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Registration</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: white; /* Set background to white */
        }

        /* Center the form container */
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .bank-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .bank-logo img {
            width: 150px;
        }

        .register-form {
            background-color: white; /* Set form background to white */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 600px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            width: 48%;
        }

        .form-row input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .register-form button {
            background-color: #0044cc;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .register-form button:hover {
            background-color: #003399;
        }

        .register-form a {
            display: block;
            margin-top: 15px;
            color: #0044cc;
            text-decoration: none;
            text-align: center;
        }

        .register-form a:hover {
            text-decoration: underline;
        }

        /* Success Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        .modal-content h3 {
            color: green;
            margin-bottom: 10px;
        }

        .modal-content a {
            color: #0044cc;
            text-decoration: none;
        }

        .modal-content a:hover {
            text-decoration: underline;
        }

        /* Show modal when success is true */
        .show-modal {
            display: flex;
        }

    </style>
</head>
<body>

<div class="register-container">
    <!-- Logo at the top center -->
    <div class="bank-logo">
        <img src="bank-logo.png" alt="Bank Logo">
        <h2>HS Bank</h2>
    </div>

    <!-- Registration Form -->
    <form class="register-form" method="POST">
        <h2>Create Your Bank Account<br><br></h2>

        <!-- Form rows split into two columns -->
        <div class="form-row">
            <div class="form-group">
                <input type="text" name="username" placeholder="Enter a Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter a Password" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your Email Address" required>
            </div>
            <div class="form-group">
                <input type="text" name="mobile_number" placeholder="Enter your Mobile Number" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <input type="text" name="account_id" placeholder="Enter Account ID" required>
            </div>
            <div class="form-group">
                <input type="text" name="name" placeholder="Enter Full Name" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <input type="text" name="account_number" placeholder="Enter Account Number" required>
            </div>
            <div class="form-group">
                <input type="text" name="account_type" placeholder="Enter Account Type" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <input type="text" name="mpin" placeholder="Enter M-Pin" required>
            </div>
        </div>

        <button type="submit">Register!</button>
        <a href="login.php">Already have an account? Login here</a>
    </form>
</div>

<!-- Success Modal -->
<div class="modal <?php echo $success ? 'show-modal' : ''; ?>">
    <div class="modal-content">
        <h3>Registration Successful!</h3>
        <p>Click <a href="login.php">here</a> to login.</p>
    </div>
</div>

</body>
</html>
