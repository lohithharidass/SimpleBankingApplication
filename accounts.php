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

// Fetch account details from the database
$sql = "SELECT account_number, account_type, balance FROM accounts WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch a single row of account details
$account = $result->fetch_assoc();

// Dummy data for user name (replace with actual session data or database retrieval)
$user_name = $_SESSION['username']; // Assuming the username is stored in the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts - HL Banking System</title>
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

        /* Header with navigation tabs */
        .header {
            background-color: #0077b6;
            padding: 20px;
            text-align: center;
            color: white;
            position: relative;
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

        .header p {
            font-size: 18px;
        }

        /* Navigation bar */
        .nav-tabs {
            display: flex;
            justify-content: center;
            background-color: #004b74;
            padding: 10px;
        }

        .nav-tabs a {
            padding: 15px 30px;
            margin: 0 10px;
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 160px); /* Full height minus header and navigation bar */
            padding: 20px;
        }

        .account-details {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 80%;
        }

        .account-details h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .account-info {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        .account-balance {
            font-size: 22px;
            font-weight: bold;
            color: #0077b6;
            margin-top: 20px;
        }

        /* Footer (Optional) */
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
    <p>Logged in as: <?php echo htmlspecialchars($user_name); ?></p>
</div>

<!-- Navigation Bar -->
<div class="nav-tabs">
    <a href="home.php">Home</a>
    <a href="accounts.php" class="active">Accounts</a>
    <a href="loans.php">Loans</a>
    <a href="cards.php">Cards</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php" class="logout">Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="account-details">
        <h2>Account Overview</h2>

        <?php if ($account): ?>
            <div class="account-info">
                <strong>Account Number:</strong> <?php echo htmlspecialchars($account['account_number']); ?>
            </div>
            <div class="account-info">
                <strong>Account Type:</strong> <?php echo htmlspecialchars($account['account_type']); ?>
            </div>
            <div class="account-balance">
                Balance: ₹<?php echo number_format($account['balance'], 2); ?>
            </div>
        <?php else: ?>
            <p>No account details found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    &copy; <?php echo date('Y'); ?> HL Banking System
</div>

</body>
</html>
