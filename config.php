<?php
// Make MySQL throw real exceptions instead of silent failures
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "my_website";

try {

    $conn = new mysqli($db_server, $db_username, $db_password, $db_name);

    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {

    die("Database connection failed.");
}
?>
