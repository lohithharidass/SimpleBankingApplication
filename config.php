<?php
$host = "localhost";
$db = "banking_system";
$user = "root"; // Default MySQL username
$pass = ""; // Default MySQL password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
