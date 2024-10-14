<?php
session_start();
require 'config.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$sql_user = "SELECT id, username, email, mobile_number, name, account_id FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();

// Fetch account details from the database
$sql_account = "SELECT account_number, account_type FROM accounts WHERE user_id = ?";
$stmt_account = $conn->prepare($sql_account);
$stmt_account->bind_param("i", $user_id);
$stmt_account->execute();
$result_account = $stmt_account->get_result();
$account = $result_account->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - HS Banking System</title>
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
        }

        /* Header with bank name and user info */
        .header {
            background-color: #0077b6;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 50px; /* Adjust the size as needed */
            height: 50px;
            border-radius: 50%; /* Makes the logo round */
            object-fit: cover; /* Ensures the image covers the circular area */
            border: 3px solid white; /* Optional: adds a white border around the logo */
        }

        .header h1 {
            margin-bottom: 10px;
        }

        .header p.user-info {
            font-size: 18px;
        }

        /* Navigation bar */
        .nav-tabs {
            display: flex;
            justify-content: center;
            background-color: #004b74;
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs a {
            padding: 10px 20px;
            margin: 0 5px;
            background-color: #0077b6;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-tabs a:hover {
            background-color: #005f88;
        }

        .nav-tabs a.active {
            background-color: #005f88;
        }

        /* Main content area */
        .main-content {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-details h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-info {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        .profile-info strong {
            display: block;
            margin-bottom: 5px;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #004b74;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<!-- Header Section -->
<div class="header">
    <img src="bank-logo.png" alt="Bank Logo" class="logo">
    <h1>Welcome to HS Banking System</h1>
    <p class="user-info">Logged in as: <?php echo htmlspecialchars($user['username']); ?></p>
</div>

<!-- Navigation Bar -->
<div class="nav-tabs">
    <a href="home.php">Home</a>
    <a href="accounts.php">Accounts</a>
    <a href="loans.php">Loans</a>
    <a href="cards.php">Cards</a>
    <a href="profile.php" class="active">Profile</a>
    <a href="logout.php" class="logout">Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <h2>Your Profile<br><br></h2>
    
    <div class="profile-info">
        <strong>User ID:</strong> <?php echo htmlspecialchars($user['id']); ?>
    </div>
    <div class="profile-info">
        <strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?>
    </div>
    <div class="profile-info">
        <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?>
    </div>
    <div class="profile-info">
        <strong>Mobile Number:</strong> <?php echo htmlspecialchars($user['mobile_number']); ?>
    </div>
    <div class="profile-info">
        <strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?>
    </div>
    <div class="profile-info">
        <strong>Account ID:</strong> <?php echo htmlspecialchars($user['account_id']); ?>
    </div>
    <div class="profile-info">
        <strong>Account Number:</strong> <?php echo htmlspecialchars($account['account_number']); ?>
    </div>
    <div class="profile-info">
        <strong>Account Type:</strong> <?php echo htmlspecialchars($account['account_type']); ?>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    &copy; <?php echo date('Y'); ?> HS Banking System
</div>

</body>
</html>
