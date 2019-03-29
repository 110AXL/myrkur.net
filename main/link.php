<!DOCTYPE html>
<html lang="en">
<head>
<include facebookPixelCode.php>
</head>
<body>
<?php
session_start();

// Include config file
require_once "../medlimir/config.php";
include 'sqlcon.php';

$mysqli = new mysqli("localhost", "u445255185_zc4r", "AXL110axl", "u445255185_sweet");
$year = $link = $name = $user_id = "";

if (isset($_GET['i']))
{
	$i = htmlspecialchars($_GET["i"]);
}
$sql = "SELECT link1, clicks FROM albums WHERE id =" . $i;

$result = $conn->query($sql);


if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
		$clicks = $row["clicks"] + 1;

		$sql2 = "UPDATE albums SET clicks=" . $clicks . " WHERE id=" . $i;

		if ($conn->query($sql2) === TRUE) {
			echo $clicks;
		} else {
			echo "Error updating record: " . $conn->error;
		}
		header("location: " . $row["link1"]);
	}
}



$conn->close();

if(isset($link) === FALSE){
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
header("location: welcome.php");
exit;
	}
	else{
		header("location: index.php");
	}
}

?>
</body>
