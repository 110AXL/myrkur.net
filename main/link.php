<!DOCTYPE html>
<html lang="en">
<head>
<?php include('res/facebookPixelCode.php'); ?>
</head>
<body>
<?php
session_start();

// Include config file
require_once '../medlimir/res/sqlcon.php';

$year = $linkUrl = $name = $user_id = "";

if (isset($_GET['i']))
{
	$i = htmlspecialchars($_GET["i"]);
}
$sql = "SELECT link1, clicks FROM albums WHERE id =" . $i;

$result = $mysqli->query($sql);


if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
		$clicks = $row["clicks"] + 1;

		$sql2 = "UPDATE albums SET clicks=" . $clicks . " WHERE id=" . $i;

		if ($mysqli->query($sql2) === TRUE) {
			echo $clicks;
		} else {
			echo "Error updating record: " . $mysqli->error;
		}
		header("location: " . $row["link1"]);
	}
}



$mysqli->close();

if(isset($linkUrl) === FALSE){
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
header("location: medlimir/welcome.php");
exit;
	}
	else{
		header("location: .index.php");
	}
}

?>
</body>
