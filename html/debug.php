<?php
header('Content-Type: text/html; charset=utf-8');
include '../config.php';

echo "<h1>Database Connection Test</h1>";

// Test connection
if ($conn->connect_error) {
    echo "<p style='color:red;'>❌ Connection Failed: " . $conn->connect_error . "</p>";
    exit();
} else {
    echo "<p style='color:green;'>✅ Connected to MySQL Successfully!</p>";
}

// Check if database exists
echo "<p>Database: " . DB_NAME . "</p>";

// Check if users table exists
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows > 0) {
    echo "<p style='color:green;'>✅ Users table exists!</p>";
} else {
    echo "<p style='color:red;'>❌ Users table NOT found!</p>";
    exit();
}

// Show table structure
echo "<h2>Table Structure:</h2>";
$result = $conn->query("DESCRIBE users");
echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row['Field'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Null'] . "</td><td>" . $row['Key'] . "</td></tr>";
}
echo "</table>";

// Show current data in table
echo "<h2>Current Users in Database:</h2>";
$result = $conn->query("SELECT * FROM users");
echo "<p>Total rows: " . $result->num_rows . "</p>";
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Surname</th><th>Email</th><th>Created At</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['surname'] . "</td><td>" . $row['email'] . "</td><td>" . $row['created_at'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No users in database yet.</p>";
}

// Test form submission
echo "<h2>Test Form Submission:</h2>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<p style='color:green;'>✅ Form submitted via POST</p>";
    echo "<p>Name: " . $_POST['name'] . "</p>";
    echo "<p>Surname: " . $_POST['surname'] . "</p>";
    echo "<p>Email: " . $_POST['email'] . "</p>";
    echo "<p>Password received: " . (strlen($_POST['password']) > 0 ? "Yes" : "No") . "</p>";
} else {
    echo "<p>Form not submitted yet. Try submitting the sign-up form.</p>";
}

$conn->close();
?>
