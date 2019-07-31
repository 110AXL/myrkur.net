<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Myrkur.net</title>
</head>

<body>
<div id="head">
	<div id="bar">
    	<div id="logo">
		<a href="http://www.myrkur.net"><img src="img/myrkur-logo.jpg" /></a>
		</div>
	</div>
</div>

<div id="menu">
	<div class="link"><a href="music.php">Music</a></div>
	<div class="link"><a href="info.php">Info</a></div>
</div>

<div id="box">
	<div id="content">
		<ul class="nav">
		<li><a href="index.php">Chronicles</a></li>
		<li><a href="events.php">Events</a></li>
    <li><a href="addAlbum.php">Admin</a></li>
		</ul>

<?PHP
	$con=mysqli_connect("localhost","u445255185_zc4r","Dim&mur%Dalur","u445255185_sweet");
	$user_name = "u445255185_zc4r";
	$password = "Dim&mur%Dalur";
	$database = "u445255185_sweet";
	$server = "localhost";
	$mysqli = new mysqli("localhost", "u445255185_zc4r", "Dim&mur%Dalur", "u445255185_sweet");


	$db_handle = mysqli_connect($server, $user_name, $password);
	$db_found = mysqli_select_db($mysqli, $database);

	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	// /* return name of current default database */
	// if ($result = $mysqli->query("SELECT DATABASE()")) {
	//     $row = $result->fetch_row();
	//     printf("Default database is %s.\n", $row[0]);
	//     $result->close();
	// }


	if ($db_found)
	{

		$SQL = "SELECT * FROM Albums ORDER BY ID DESC";
		// $result = mysqli_query($mysqli, $SQL);

		if ($result = $mysqli->query($SQL)) {

		while ( $row = $result->fetch_assoc())
		{
    		$string = $row['Genre'];
  			$tags = explode(',', $string);
			$last_key = key( array_slice( $tags, -1, 1, TRUE ) );
			$label = $row['Label'];

echo			"<div id='post'>";
echo				"<div class='.p-pic'>";
echo					"<a href='viewAlbum.php?id=" . $row['ID'] . "'><img src=" . $row['PathToImage'] . " width=300px; height=300px; /> </a>";
echo				"</div>";

echo				"<div id='p-name'>";
echo					"<a href='viewAlbum.php?id=" . $row['ID'] . "'>" . $row['Artist'] . " - " . $row['Album'] . "</a>";
echo				"</div>";

echo				"<div id='p-info'>";
echo					"Released " . $row['Released'] . "<br />";
echo					"Rating: " . $row['Rating'] . "<br />";
echo					"Label  : <a href='music.php?label=" . $label . "'>" . $label . "</a><br />";
echo					"Genre  : ";
						foreach($tags as $key)
						{
							$word=trim($key);
							$safe=mysqli_real_escape_string( $word );
							if ($key == $tags[count($tags) - 1])
								echo "<a href='music.php?genre=" . $safe . "'>" . $safe . "</a>";
							else
								echo "<a href='music.php?genre=" . $safe . "'>" . $safe . "</a>, ";
						}

echo				"</div>";
echo			"</div>";
		}
		$result->free();
}
		mysql_close($db_handle);
	}
	else
	{

	print "Database NOT Found ";
	mysql_close($db_handle);
	}
?>

	</div>
	<br clear="all" />
</div>
</body>
</html>
