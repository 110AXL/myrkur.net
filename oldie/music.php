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

	$db_handle = mysqli_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found)
	{

		$SQL = "SELECT * FROM Albums ORDER BY ID DESC";
		$result = mysql_query($SQL);

		while ( $db_field = mysql_fetch_assoc($result) )
		{
    		$string = $db_field['Genre'];
  			$tags = explode(',', $string);
			$last_key = key( array_slice( $tags, -1, 1, TRUE ) );
			$label = $db_field['Label'];

echo			"<div id='post'>";
echo				"<div class='.p-pic'>";
echo					"<a href='viewAlbum.php?id=" . $db_field['ID'] . "'><img src=" . $db_field['PathToImage'] . " width=300px; height=300px; /> </a>";
echo				"</div>";

echo				"<div id='p-name'>";
echo					"<a href='viewAlbum.php?id=" . $db_field['ID'] . "'>" . $db_field['Artist'] . " - " . $db_field['Album'] . "</a>";
echo				"</div>";

echo				"<div id='p-info'>";
echo					"Released " . $db_field['Released'] . "<br />";
echo					"Rating: " . $db_field['Rating'] . "<br />";
echo					"Label  : <a href='music.php?label=" . $label . "'>" . $label . "</a><br />";
echo					"Genre  : ";
						foreach($tags as $key)
						{
							$word=trim($key);
							$safe=mysql_real_escape_string( $word );
							if ($key == $tags[count($tags) - 1])
								echo "<a href='music.php?genre=" . $safe . "'>" . $safe . "</a>";
							else
								echo "<a href='music.php?genre=" . $safe . "'>" . $safe . "</a>, ";
						}

echo				"</div>";
echo			"</div>";
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
