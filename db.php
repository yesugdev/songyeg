<?php
// Database configuration
$dbHost = 'localhost'; // Change this if your MySQL server is hosted elsewhere
$dbUsername = 'root'; // Replace 'your_username' with your MySQL username
$dbPassword = 'YRTah36D@'; // Replace 'your_password' with your MySQL password
$dbName = 'yeg_project'; // Replace 'your_database' with the name of your MySQL database

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
