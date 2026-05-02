<?php
// 1. Connect to MySQL server without selecting a database first
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, "", DB_PORT);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("<h2 style='font-family:sans-serif;color:red;text-align:center;margin-top:100px'>Database server connection failed.</h2>");
}

// 2. Create database if it doesn't exist
$dbName = DB_NAME;
$conn->query("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

// 3. Select the database
$conn->select_db($dbName);

// 4. Automatically create tables if they don't exist
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('artist', 'buyer') NOT NULL
)");

$conn->query("CREATE TABLE IF NOT EXISTS artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    artist_id INT,
    price DECIMAL(10, 2),
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(artist_id) REFERENCES users(id) ON DELETE CASCADE
)");

$conn->query("CREATE TABLE IF NOT EXISTS purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artwork_id INT,
    buyer_id INT,
    amount DECIMAL(10, 2),
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(artwork_id) REFERENCES artworks(id) ON DELETE CASCADE,
    FOREIGN KEY(buyer_id) REFERENCES users(id) ON DELETE CASCADE
)");
?>