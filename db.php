<?php
// Database configuration
$dbHost = 'localhost'; 
$dbUsername = 'root'; 
$dbPassword = 'YRTah36D@'; 
$dbName = 'yeg_project'; 

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
