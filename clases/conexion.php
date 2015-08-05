<?php
$servername = "localhost";
$username = "u215464673_alter";
$password = "05b06909ec13";
$database = "u215464673_proce";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>