<?php
session_start();
require 'config.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Dummy data for bank details (Replace with actual data as needed)
$bank_details = [
    'name' => 'HS Bank',
    'ifsc_code' => 'HSLDB008676',
    'address' => 'P.B.NO.361, 24, CHINAKADAI ST, TIRUCHIRAPALLI, PINCODE - 620002',
    'contact_number' => '+91 944 284 2610',
    'email' => 'contact@hsbank.com'
];

$offers = [
    'Festive Offers' => 'Special discounts and rewards during the festive season.',
    'Referral Program' => 'Refer a friend and get cashback rewards.',
    'Seasonal Interest Rates' => 'Get higher interest rates on savings accounts during the summer months.'
];

$account_services = [
    'Account Opening' => 'Easy and quick process to open savings or checking accounts online.',
    'Account Maintenance' => 'Manage your account, set up automatic payments, and more.',
    'Account Closure' => 'Close your account with a simple request process.'
];

$documents_required = [
    'Proof of Identity' => 'A government-issued ID such as a passport or driver\'s license.',
    'Proof of Address' => 'Utility bill or bank statement with your current address.',
    'Photographs' => 'Recent passport-sized photographs.'
];

$loan_offers = [
    'Home Loan' => 'Competitive interest rates for purchasing or constructing a home.',
    'Personal Loan' => 'Unsecured loans with flexible repayment options.',
    'Auto Loan' => 'Finance your new or used car with easy EMIs.'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - HL Banking System</title>
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
            align-items: flex-start;
            flex-direction: column;
            padding: 20px;
            margin: 0 auto;
            max-width: 1200px;
        }

        .section {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .section p {
            font-size: 18px;
            color: #333;
        }

        .item {
            margin-bottom: 15px;
        }

        .item strong {
            display: block;
            font-size: 20px;
            color: #0077b6;
            margin-bottom: 5px;
        }

        .item p {
            font-size: 18px;
            color: #333;
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
    <p>Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
</div>

<!-- Navigation Bar -->
<div class="nav-tabs">
    <a href="home.php" class="active">Home</a>
    <a href="accounts.php">Accounts</a>
    <a href="loans.php">Loans</a>
    <a href="cards.php">Cards</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php" class="logout">Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Bank Details Section -->
    <div class="section bank-details">
        <h2>Bank Details</h2>
        <div class="item">
            <strong>Bank Name:</strong> <?php echo htmlspecialchars($bank_details['name']); ?>
        </div>
        <div class="item">
            <strong>IFSC Code:</strong> <?php echo htmlspecialchars($bank_details['ifsc_code']); ?>
        </div>
        <div class="item">
            <strong>Address:</strong> <?php echo htmlspecialchars($bank_details['address']); ?>
        </div>
        <div class="item">
            <strong>Contact Number:</strong> <?php echo htmlspecialchars($bank_details['contact_number']); ?>
        </div>
        <div class="item">
            <strong>Email:</strong> <?php echo htmlspecialchars($bank_details['email']); ?>
        </div>
    </div>

    <!-- Offers Section -->
    <div class="section offers">
        <h2>Current Offers</h2>
        <?php foreach ($offers as $offer_title => $offer_description): ?>
            <div class="item">
                <strong><?php echo htmlspecialchars($offer_title); ?></strong>
                <p><?php echo htmlspecialchars($offer_description); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Account Services Section -->
    <div class="section account-services">
        <h2>Account Services</h2>
        <?php foreach ($account_services as $service_title => $service_description): ?>
            <div class="item">
                <strong><?php echo htmlspecialchars($service_title); ?></strong>
                <p><?php echo htmlspecialchars($service_description); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Documents Required Section -->
    <div class="section documents-required">
        <h2>Documents Required to Open an Account</h2>
        <?php foreach ($documents_required as $document_title => $document_description): ?>
            <div class="item">
                <strong><?php echo htmlspecialchars($document_title); ?></strong>
                <p><?php echo htmlspecialchars($document_description); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Loan Offers Section -->
    <div class="section loan-offers">
        <h2>Loan Offers</h2>
        <?php foreach ($loan_offers as $loan_title => $loan_description): ?>
            <div class="item">
                <strong><?php echo htmlspecialchars($loan_title); ?></strong>
                <p><?php echo htmlspecialchars($loan_description); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    &copy; <?php echo date('Y'); ?> HS Banking System
</div>

</body>
</html>
