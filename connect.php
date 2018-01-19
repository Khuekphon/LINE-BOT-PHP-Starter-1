<?php
$servername = "202.29.22.23";
$username = "chatbot";
$password = "chatbot123456";
$DB = "chatbot";

// Create connection
$conn = new mysqli($servername, $username, $password,$DB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>