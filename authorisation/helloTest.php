<?php
$conn = new mysqli("localhost", "root", "");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL server successfully!";
    
    // Check if database exists
    if ($conn->select_db("bastion_db")) {
        echo "<br>Database connection successful!";
    } else {
        echo "<br>Database doesn't exist or can't be accessed";
    }
}
$conn->close();
?>