<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include 'config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($name) || empty($surname) || empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: /html/sign-up.html");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format!";
        header("Location: /html/sign-up.html");
        exit();
    }

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email already registered!";
        header("Location: /html/sign-up.html");
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    $insert = $conn->prepare("INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)");
    
    if (!$insert) {
        $_SESSION['error'] = "Database error: " . $conn->error;
        header("Location: /html/sign-up.html");
        exit();
    }
    
    $insert->bind_param("ssss", $name, $surname, $email, $hashedPassword);

    if ($insert->execute()) {
        $_SESSION['success'] = "Registration successful! Please log in.";
        header("Location: /html/sign-in.html");
        exit();
    } else {
        $_SESSION['error'] = "Registration failed: " . $insert->error;
        header("Location: /html/sign-up.html");
        exit();
    }

    $insert->close();
    $checkEmail->close();
}

$conn->close();
?>
