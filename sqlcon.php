<?php
$servername = "localhost";
$username = "u445255185_zc4r";
$password = "AXL110axl";
$dbname = "u445255185_sweet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>