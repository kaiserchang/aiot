<?php
$servername = "localhost";
$username = "test123";
$password = "test123";
$dbname = "aiotdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert 100 records
for ($i = 0; $i < 100; $i++) {
    $temp = rand(-50, 50);
    $humi = rand(0, 100);
    $sql = "INSERT INTO sensors (temp, humi) VALUES ($temp, $humi)";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully\n";
    } else {
        echo "Error: " . $sql . "\n" . $conn->error;
    }
}

$conn->close();
?>
