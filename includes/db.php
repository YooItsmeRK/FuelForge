<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // default WAMP password
$dbname = 'fuelforge';

// First connect without database to create it if it doesn't exist
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    $conn->select_db($dbname);
} else {
    die(json_encode(["status" => "error", "message" => "Error creating database: " . $conn->error]));
}

// Create recipes table if not exists (including an approved column if we want a review system, but keeping it simple for now)
$tableSql = "CREATE TABLE IF NOT EXISTS recipes (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($tableSql)) {
    die(json_encode(["status" => "error", "message" => "Error creating recipes table: " . $conn->error]));
}

// Create users table if not exists
$usersTableSql = "CREATE TABLE IF NOT EXISTS users (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($usersTableSql)) {
    die(json_encode(["status" => "error", "message" => "Error creating users table: " . $conn->error]));
}

// Create messages table if not exists
$messagesTableSql = "CREATE TABLE IF NOT EXISTS messages (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  subject VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($messagesTableSql)) {
    die(json_encode(["status" => "error", "message" => "Error creating messages table: " . $conn->error]));
}

// Ensure recipes table has image column
$checkCol = $conn->query("SHOW COLUMNS FROM recipes LIKE 'image'");
if ($checkCol && $checkCol->num_rows === 0) {
    $conn->query("ALTER TABLE recipes ADD COLUMN image VARCHAR(255) DEFAULT NULL");
}

// Ensure recipes table has prep_time column
$checkTimeCol = $conn->query("SHOW COLUMNS FROM recipes LIKE 'prep_time'");
if ($checkTimeCol && $checkTimeCol->num_rows === 0) {
    $conn->query("ALTER TABLE recipes ADD COLUMN prep_time VARCHAR(50) DEFAULT NULL");
}
?>
