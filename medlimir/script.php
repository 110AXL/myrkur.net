<?php
// Include config file
require_once "config.php";

	/* Prepared statement, stage 2: bind and execute */
$artist = htmlspecialchars($_GET["artist"]);
$album = htmlspecialchars($_GET["album"]);
$link1 = htmlspecialchars($_GET["link"]);

 
// Define variables and initialize with empty values
$artist = $album = $link1 = $link2 = "";

$artist_err = $album_err = $link1_err = $link2_err = "";


$mysqli = new mysqli("localhost", "u445255185_zc4r", "AXL110axl", "u445255185_sweet");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

/* Non-prepared statement
if (!$mysqli->query("DROP TABLE IF EXISTS test") || !$mysqli->query("CREATE TABLE test(id INT)")) {
    echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
} */

/* Prepared statement, stage 1: prepare */
if (!($stmt = $mysqli->prepare("INSERT INTO albums(artist, album, link1) VALUES (?,?,?)"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("sss", $artist, $album, $link1)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

/* explicit close recommended */
$stmt->close();

/* Non-prepared statement 
$res = $mysqli->query("SELECT (artist) FROM albums");
var_dump($res->fetch_all());*/
?>