<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Myrkur.net | Arr!</title>

  <!-- Font Awesome Icons -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">


<link href="../css/creative.css" rel="stylesheet">
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
    <li><a href="addAlbum.php">Add album</a></li>
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
//****
<section id="portfolio">
  <div class="container-fluid p-0">
        <div class="row no-gutters">
    <?php

      switch($_SERVER['QUERY_STRING']) {
          case 'user':
              $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY users.username DESC";
              break;
          case 'artist':
              $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.artist DESC";
              break;
          case 'added':
              $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.created_at DESC";
              break;
          case 'released':
              $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.year DESC";
              break;
          case 'clicks':
              $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.clicks DESC";
              break;

          default:
              $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.id DESC";
      }

      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
         $resized_link = $row["img"];
         $removed_spaces = str_replace(" ","%20",$resized_link);
         echo "<div class='col-lg-3 col-sm-3'>";
          echo "<a class='portfolio-box' target=_blank title='" . $row["artist"]. " - " . $row["album"]. " [" . $row["username"] . "]' href=main/link.php?i='" . $row["id"]."' alt=''>";
          echo "<img class='img-fluid' height='100%' width='100%' src='/medlimir/uploads/" . $removed_spaces . "' alt=''>";
          echo "<div class='portfolio-box-caption'>";
            echo "<div class='project-category text-white-50'>" . $row["artist"] . "</div>";
              echo "<div class='project-name'>" . $row["album"] . "</div></div></a></div>";
         // echo "<p class='info' title='Year & link clicks.'><a href=main/link.php?i='" . $row["id"]."'>" . $row["year"] . "</a></p><div id=username>" . $row["username"] . "</div><div id=clicks>" . $row["clicks"] . "</div></div>";
         }
       }

      $mysqli->close(); ?>
//****
//
// 	if ($db_found)
// 	{
//
// 		$SQL = "SELECT * FROM Albums ORDER BY ID DESC";
// 		// $result = mysqli_query($mysqli, $SQL);
//
// 		if ($result = $mysqli->query($SQL)) {
//
// 		while ( $row = $result->fetch_assoc())
// 		{
//     		$string = $row['Genre'];
//   			$tags = explode(',', $string);
// 			$last_key = key( array_slice( $tags, -1, 1, TRUE ) );
// 			$label = $row['Label'];
//
//
// echo			"<div id='post'>";
// echo				"<div class='.p-pic'>";
// echo					"<a href='viewAlbum.php?id=" . $row['ID'] . "'><img src=../medlimir/uploads" . $removed_spaces . " width=300px; height=300px; /> </a>";
// echo				"</div>";
//
// echo				"<div id='p-name'>";
// echo					"<a href='viewAlbum.php?id=" . $row['ID'] . "'>" . $row['artist'] . " - " . $row['album'] . "</a>";
// echo				"</div>";
//
// echo				"<div id='p-info'>";
// // echo					"Released " . $row['Released'] . "<br />";
// // echo					"Rating: " . $row['Rating'] . "<br />";
// // echo					"Label  : <a href='music.php?label=" . $label . "'>" . $label . "</a><br />";
// // echo					"Genre  : ";
// // 						foreach($tags as $key)
// // 						{
// // 							$word=trim($key);
// // 							$safe=mysqli_real_escape_string( $word );
// // 							if ($key == $tags[count($tags) - 1])
// // 								echo "<a href='music.php?genre=" . $safe . "'>" . $safe . "</a>";
// // 							else
// // 								echo "<a href='music.php?genre=" . $safe . "'>" . $safe . "</a>, ";
// // 						}
//
// echo				"</div>";
// echo			"</div>";
// 		}
// 		$result->free();
// }
// 		mysqli_close($db_handle);
// 	}
// 	else
// 	{
//
// 	print "Database NOT Found ";
// 	mysqli_close($db_handle);
// 	}
// ?>

	</div>
	<br clear="all" />
</div>
</body>
</html>
