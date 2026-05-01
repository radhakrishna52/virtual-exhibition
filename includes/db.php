<?php
// Create database connection with port support
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if ($conn->connect_error) {
    // Log error but don't die - show friendly message
    error_log("DB Connection failed: " . $conn->connect_error);
    die("<h2 style='font-family:sans-serif;color:red;text-align:center;margin-top:100px'>Database connection failed. Please check server configuration.</h2>");
}
?>