<?php
$servername = "localhost";
$username = "test123";
$password = "test123";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE aiotdb";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("aiotdb");

// Create table without CHECK constraints
$sql = "CREATE TABLE sensors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    temp INT DEFAULT 25,
    humi INT DEFAULT 30,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table sensors created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
