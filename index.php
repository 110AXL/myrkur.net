 <!-- Example -->
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="medlimir/res/default.css">

<?php include('medlimir/res/facebookPixelCode.php'); ?>
<link rel="shortcut icon" type="image/png" href="main/favicon-16x16.png"/>
</head>
<body bgcolor="black">
 <?php
session_start();
include 'medlimir/res/ip.php';
include 'main/header.php';
include 'medlimir/res/logo.php';
require_once 'main/sqlcon.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo "<div id='P'>";

if (!empty($_GET["genre"])) {
	echo "<h1>Genre: " . $_GET["genre"] . "</h1>";
	$genre = $_GET["genre"];
    $sql = "SELECT albums.id, albums.artist, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id WHERE albums.genre ='". $genre ."' ORDER BY albums.id DESC";
	}
	else {
    $sql = "SELECT albums.id, albums.artist, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.id DESC";
	}


$result = $mysqli->query($sql);
echo "<div class='grid-container grid-container--fill'>";


if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$resized_link = $row["img"];
		$removed_spaces = str_replace(" ","%20",$resized_link);
		echo "<div class='grid-element'><a target=_blank title='" . $row["artist"]. " - " . $row["album"]. " [" . $row["username"] . "]' href=main/link.php?i='" . $row["id"]."'><img width=200 height=200 src=medlimir/uploads/" . $removed_spaces . " /><div class='title'><p>" . $row["artist"] . " - " . $row["album"] . "</a></div></p></div>";
		}
	}

$mysqli->close();
echo "</div>";

echo "</div>";
echo "Thanks, man.";
?>
</body>
</html>
