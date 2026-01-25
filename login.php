<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include 'config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email and password are required!";
        header("Location: /html/sign-in.html");
        exit();
    }

    // Get user from database
    $login = $conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    $login->bind_param("s", $email);
    $login->execute();
    $result = $login->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['success'] = "Login successful!";

            // Redirect to dashboard (you can create this page)
            header("Location: /html/index.html");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password!";
            header("Location: /sign-in.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not found!";
        header("Location: /html/sign-in.html");
        exit();
    }

    $login->close();
}

$conn->close();
?>
