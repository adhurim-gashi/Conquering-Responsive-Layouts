<?php
/**
 * User Registration Handler
 * Processes sign-up form with PDO, validation, and CSRF protection
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
header('Content-Type: text/html; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Include required files
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Handle only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die('Method not allowed.');
}

// Verify CSRF token
if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
    setFlash('error', 'Security token invalid. Please try again.');
    header('Location: sign-up.html');
    exit();
}

// Get and sanitize input
$name = sanitizeInput($_POST['name'] ?? '');
$surname = sanitizeInput($_POST['surname'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validate input
$errors = validateSignUpForm($name, $surname, $email, $password);

if (!empty($errors)) {
    setFlash('error', implode(' ', $errors));
    header('Location: sign-up.html');
    exit();
}

try {
    // Check if email already exists
    $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        setFlash('error', 'Email already registered. Please use a different email or log in.');
        header('Location: sign-up.html');
        exit();
    }

    // Hash password securely
    $hashedPassword = hashPassword($password);

    // Insert user with prepared statement
    $stmt = $conn->prepare(
        'INSERT INTO users (name, surname, email, password, created_at) 
         VALUES (?, ?, ?, ?, NOW())'
    );
    $stmt->execute([$name, $surname, $email, $hashedPassword]);

    // Success message
    setFlash('success', 'Registration successful! Please log in.');
    header('Location: sign-in.html');
    exit();

} catch (PDOException $e) {
    // Log error (don't expose in production)
    error_log('Registration error: ' . $e->getMessage());
    setFlash('error', 'Registration failed. Please try again later.');
    header('Location: sign-up.html');
    exit();
}
?>
