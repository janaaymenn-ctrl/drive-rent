<?php
// Database Configuration
$host = 'localhost';
$db_name = 'drive_rent_db';
$db_user = 'root';
$db_password = '';

try {
    $conn = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8");
} catch (Exception $e) {
    die("Database Connection Error: " . $e->getMessage());
}
?>
