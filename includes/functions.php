<?php
/**
 * Helper Functions
 * Validation, sanitization, and utility functions
 */

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Sanitize string input
 */
function sanitizeInput($data) {
    return trim(htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));
}

/**
 * Validate email format
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate password strength (minimum 6 chars)
 */
function isValidPassword($password) {
    return strlen($password) >= 6;
}

/**
 * Validate form data
 */
function validateSignUpForm($name, $surname, $email, $password) {
    $errors = [];

    // Check required fields
    if (empty(trim($name))) {
        $errors[] = 'Name is required.';
    }
    if (empty(trim($surname))) {
        $errors[] = 'Surname is required.';
    }
    if (empty(trim($email))) {
        $errors[] = 'Email is required.';
    }
    if (empty($password)) {
        $errors[] = 'Password is required.';
    }

    // Validate email format
    if (!empty($email) && !isValidEmail($email)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate password strength
    if (!empty($password) && !isValidPassword($password)) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    return $errors;
}

/**
 * Hash password securely
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

/**
 * Verify password against hash
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Set flash message in session
 */
function setFlash($type, $message) {
    $_SESSION['flash'][$type] = $message;
}

/**
 * Get and clear flash message
 */
function getFlash($type = null) {
    if ($type === null) {
        $flash = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $flash;
    }

    $message = $_SESSION['flash'][$type] ?? null;
    unset($_SESSION['flash'][$type]);
    return $message;
}
?>
