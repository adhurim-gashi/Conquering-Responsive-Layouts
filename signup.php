<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php'; // Make sure config.php path is correct

// Check connection
if (!$conn) {
    die("DB connection failed: " . mysqli_connect_error());
}

// Only handle POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request");
}

// Get POST data
$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validate fields
if (!$name || !$surname || !$email || !$password) {
    die("All fields required");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email");
}

// Hash the password
$hashed = password_hash($password, PASSWORD_BCRYPT);

// Prepare insert
$stmt = $conn->prepare(
    "INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)"
);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssss", $name, $surname, $email, $hashed);

// Execute insert
if ($stmt->execute()) {
    echo "Registered successfully";
} else {
    echo "Insert failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
