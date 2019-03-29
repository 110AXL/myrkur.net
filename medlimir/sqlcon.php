<?php
$mysqli = new mysqli("localhost", "u445255185_zc4r", "AXL110axl", "u445255185_sweet");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>
