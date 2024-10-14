<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - HL Banking System</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .logout-message {
            text-align: center;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 600px;
        }

        .logout-message img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .logout-message h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .logout-message p {
            font-size: 18px;
            color: #333;
            margin-bottom: 30px;
        }

        .logout-message a {
            text-decoration: none;
            color: #0077b6;
            font-weight: bold;
            font-size: 18px;
        }

        .logout-message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="logout-message">
    <!-- Replace 'bank-logo.png' with the path to your actual bank logo -->
    <img src="bank-logo.png" alt="HS Bank Logo">
	<h2> HS Bank </h2>
    <h1>Thank You for Banking with Us!</h1>
    <p>You have been successfully logged out. We hope to see you again soon.</p>
    <p><a href="login.php">Click here to log in again</a></p>
</div>

<!-- Redirect to login page after 15 seconds -->
<script>
    setTimeout(function() {
        window.location.href = 'login.php';
    }, 15000); // 15000 milliseconds = 15 seconds
</script>

</body>
</html>
