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
	<div class="link"><a href="games.php">Games</a></div>
	<div class="link"><a href="sports.php">Sports</a></div>
	<div class="link"><a href="forum.php">Forum</a></div>
	<div class="link"><a href="info.php">Info</a></div>
</div>

<div id="box">
	<div id="content">
		<ul class="nav">
			<li><a href="games.php">Play</a></li>
			<li><a href="vod.php">Videos</a></li>
   	    	<li><a href="addVideo.php">Admin</a></li>
		</ul>
        <div id="gameselection">
			<p class="pos_right">
				<form>
                <p> Select game(s):</p>
				<div id="tic"><input type="checkbox" name="option3" value="Cheese"> LOL</div>
				<div id="tic"><input type="checkbox" name="option3" value="Cheese"> SC2</div>
				<div id="tic"><input type="checkbox" name="option3" value="Cheese"> HotS</div><br />
				<div id="tic"><input type="checkbox" name="option3" value="Cheese"> CS:16</div>
				<div id="tic"><input type="checkbox" name="option3" value="Cheese"> CS:GO</div>
				<div id="tic"><input type="checkbox" name="option3" value="Cheese"> TF2</div><br />
				<div id="tic"><input type="checkbox" name="option3" value="Cheese"> HON</div>
				<div id="tic"><input type="checkbox" name="option3" value="Cheese"> WOW</div>
				<div id="tic"><input type="checkbox" name="option3" value="Cheese"> NS2</div>
				</form>
			</p>
        </div>
        <div id="gameselectionfiller">
			<ul class="navGames">
                 Clan | Nick
				<li><a href="games.php">Archive</a></li>
				<li><a href="vod.php">Browse</a></li>
     			<li><a href="stats.php">Play</a></li>
			</ul>
        </div>
<?PHP
	$con=mysqli_connect("localhost","myrkurne","on8v/Vos785","myrkurne_Music");
	$user_name = "myrkurne";
	$password = "on8v/Vos785";
	$database = "myrkurne_Music";
	$server = "localhost";

	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) 
	{

		$SQL = "SELECT * FROM Albums";
		$result = mysql_query($SQL);

		while ( $db_field = mysql_fetch_assoc($result) ) 
		{
echo			"<div id='postGames'>";
echo					"<div id='postGames0'>" . $db_field['Artist']  . "</div>";
echo					"<div id='postGames1'>" . $db_field['Rating'] . "  " . "</div>";
echo					"<div id='postGames2'>" . $db_field['Label'] . "  " . "</div>";
echo					"<div id='postGames3'>" . $db_field['Genre'] . "</div>";
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
