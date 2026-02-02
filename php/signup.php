<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method");
}

$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$name || !$surname || !$email || !$password) {
    die("All fields are required");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

$hashed = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare(
    "INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("ssss", $name, $surname, $email, $hashed);

try {
    $stmt->execute();
    echo "Registered successfully! Your user ID: " . $conn->insert_id;
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        die("Error: This email is already registered.");
    } else {
        die("DB ERROR: " . $e->getMessage());
    }
}

$stmt->close();
$conn->close();
?>
