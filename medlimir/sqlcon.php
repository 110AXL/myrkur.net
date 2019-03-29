<?php
$mysqli = new mysqli("localhost", "u445255185_zc4r", "Dim&mur%Dalur", "u445255185_sweet");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
	$sqlcon = "mysqli tengt gagnagrunni.<br/>";
	echo $sqlcon;
}

$mysqli2 = new mysqli("localhost", "u445255185_zc4r", "Dim&mur%Dalur", "u445255185_sweet");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
	$sqlcon = "mysqli2 tengt gagnagrunni.<br/>";
	echo $sqlcon;
}

/*	echo get_include_path(); */
?>
