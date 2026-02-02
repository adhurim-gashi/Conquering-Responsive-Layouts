<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "my_website";

try {
    $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
} catch (mysqli_sql_exception $e) {
    die("DB connection failed");
}
?>