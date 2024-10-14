<?php
require 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mpin = $_POST['mpin'];
    $user_id = $_SESSION['user_id'];

    // Fetch the stored MPIN from the database for the logged-in user
    $sql = "SELECT mpin FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stored_mpin = $user['mpin']; // The stored MPIN in the database

        // Compare the entered MPIN directly with the stored MPIN (if stored as plaintext)
        if ($mpin === $stored_mpin) {
            // MPIN is correct, redirect to the main page
            header('Location: index.php');
            exit;
        } else {
            $error = "Invalid MPIN!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPIN Verification</title>
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
        .mpin-container {
            display: flex;
            justify-content: left;
            align-items: center;
            height: 100vh;
 background-image: url('tech4.jpg'); 
            background-size: cover;
            background-position: center;
        }

	

        /* Form styling */
        .mpin-form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .mpin-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .mpin-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
 border-radius: 10px;
            border-radius: 5px;
            font-size: 16px;
        }

        .mpin-form button {
            background-color: #0077b6;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .mpin-form button:hover {
            background-color: #005f88;
        }

        /* Error message styling */
        .error-msg {
            color: red;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="mpin-container">
    <form class="mpin-form" method="POST">
        <h2>Enter MPIN</h2>
        <input type="password" name="mpin" placeholder="Enter your MPIN" required><br>
        <button type="submit">Verify MPIN</button>
        <?php if (isset($error)): ?>
            <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
