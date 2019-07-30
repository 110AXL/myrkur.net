<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	$id = htmlspecialchars($_GET["id"]); 

	$con=mysqli_connect("localhost","myrkurne","on8v/Vos785","myrkurne_Music");
	$user_name = "myrkurne";
	$password = "on8v/Vos785";
	$database = "myrkurne_Music";
	$server = "localhost";

	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);

	$result = mysqli_query($con,"SELECT * FROM Albums WHERE ID=" . $id);
	
	
	/* USER-AGENTS: Are you a bot, mobile or pc browser?
	================================================== 
		function check_user_agent ( $type = NULL ) {
       	$user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
       	if ( $type == 'bot' ) 
	    {
           	    // matches popular bots
               	if ( preg_match ("/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent ) ) {
                       return true;
                       // watchmouse|pingdom\.com are "uptime services"
        		}
       		 	} else if ( $type == 'browser' ) {
                	// matches core browser types
               		if ( preg_match ( "/mozilla\/|opera\//", $user_agent ) ) {
                        return true;
              		}
        		} else if ( $type == 'mobile' ) {
             	    // matches popular mobile devices that have small screens and/or touch inputs
        	        // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
      	            // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
               		if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
                        // these are the most common
                        return true;
        		} else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
                    // these are less common, and might not be worth checking
                    return true;
					}
        		}
        		return false;
		    } 
	*/

	
?>

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
<div id="c-left" class="container">
<?php

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

while($row = mysqli_fetch_array($result))
{
	$Soundcloud = $row['Link_Soundcloud'];
	$Youtube = $row['Link_Youtube'];
	$Spotify = $row['Link_Spotify'];
	$SpotifyURI = $row['Link_SpotifyURI'];
	$ReleaseDate = new DateTime($row['Released']);
	$ReviewDate = new DateTime($row['datetime']);


	echo "<img src=" . $row['PathToImage'] . " width=350px; height=350px; border=9; /></div>";
	echo "<div id=c-right><center><h3>" . $row['Album'] . "</h3>";
	echo "by <h1>" .  $row['Artist'] . "</h1>";
	echo $ReleaseDate->format('d. F Y') . "<br /><br /></center>";
	echo "Genre: " .  $row['Genre'] . "<br />";
	echo "Label: " .  $row['Label'] . "<br />";
	echo "Rating: " .  $row['Rating'] . "<br />";
	
	
	echo "</div><div id=c-right2><center>";
	
	if ($Soundcloud != NULL)
		echo "<a href=". $Soundcloud . "><img src=img/soundcloudbw.jpg onmouseover=this.src='../../img/soundcloud.jpg' onmouseout=this.src='../../img/soundcloudbw.jpg' width=50px; height=50px; /></a>";
	
	if ($Youtube != NULL)
	echo "<a href=". $Youtube . "><img src=img/youtubebw.jpg onmouseover=this.src='../../img/youtube.jpg' onmouseout=this.src='../../img/youtubebw.jpg' width=50px; height=50px; /></a>";
	
	if ($SpotifyURI != NULL || $Spotify != NULL)
	{
	echo "<a href=";  
		if(isMobile())
    		echo $SpotifyURI;
		else
    		echo $Spotify;
	echo "><img src=img/spotifybw.jpg onmouseover=this.src='../../img/spotify.jpg' onmouseout=this.src='../../img/spotifybw.jpg' width=50px; height=50px; /></a></center>";
	}

	echo "</div><div id=c-right3><div class=right>reviewed "; echo $ReviewDate->format('d. F Y'); echo "</div></div>";

	echo "<div id=critique>" . $row['Critique'] . "</div>";
}
?> 
</div>
</div>
</body>
</html>
