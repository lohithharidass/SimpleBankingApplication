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

// Fetch card details from the database
$sql = "SELECT card_number, card_type, expiry_date FROM cards WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Array to hold card details
$cards = [];
while ($row = $result->fetch_assoc()) {
    $cards[] = $row;
}

// Assuming the username is stored in the session
$user_name = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards - HL Banking System</title>
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

        .card-details {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 80%;
        }

        .card-details h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .card-info {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        .card-info strong {
            display: block;
            margin-bottom: 5px;
        }

        .card-info .card-number {
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: 2px;
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
    <a href="accounts.php">Accounts</a>
    <a href="loans.php">Loans</a>
    <a href="cards.php" class="active">Cards</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php" class="logout">Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="card-details">
        <h2>Your Cards</h2>

        <?php if (count($cards) > 0): ?>
            <?php foreach ($cards as $card): ?>
                <div class="card-info">
                    <strong>Card Number:</strong>
                    <span class="card-number"><?php echo htmlspecialchars($card['card_number']); ?></span>
                </div>
                <div class="card-info">
                    <strong>Card Type:</strong> <?php echo htmlspecialchars($card['card_type']); ?>
                </div>
                <div class="card-info">
                    <strong>Expiry Date:</strong> <?php echo htmlspecialchars($card['expiry_date']); ?>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No cards found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    &copy; <?php echo date('Y'); ?> HL Banking System
</div>

</body>
</html>
