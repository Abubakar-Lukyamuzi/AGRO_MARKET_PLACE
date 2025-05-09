<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "AGRO_MARKET_PLACE";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>