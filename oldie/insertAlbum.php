<?php
$Password = $_POST["Password"];
if ($Password == "DimmurDalur"){

$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);


$Album = $_POST["Album"];
$Artist = $_POST["Artist"];
$Label = $_POST["Label"];
$Genre = $_POST["Genre"];
$Released = $_POST["Released"];
$Link_Spotify = $_POST["Link_Spotify"];
$Link_Spotify = $_POST["Link_SpotifyURI"];
$Link_Youtube = $_POST["Link_Youtube"];
$Link_Soundcloud = $_POST["Link_Soundcloud"];
$Link_Other = $_POST["Link_Other"];
$Critique = $_POST["Critique"];
$Rating = $_POST["Rating"];
echo "Album: " . $Album . "<br />";
echo "Artist: " . $Artist . "<br />";
echo "Label: " . $Label . "<br />";
echo "Genre: " . $Genre . "<br />";
echo "Released: " . $Released. "<br />";
echo "Spotify: " . $Link_Spotify. "<br />";
echo "Youtube: " . $Link_Youtube. "<br />";
echo "Soundcloud: " . $Link_Soundcloud . "<br />";
echo "Other: " . $Link_Other . "<br />";
echo "Rating: " . $Rating . "<br />";
$AlbumNoSpace = str_replace(' ', '', $Album);
$ArtistNoSpace = str_replace(' ', '', $Artist);
$PathToImage = "Music/" . $ArtistNoSpace . "/" . $AlbumNoSpace . ".jpg";

if (!file_exists('Music/' . $ArtistNoSpace )) 
	  {
    	mkdir('Music/' . $ArtistNoSpace, 0777, true);
      }


if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
   
	if (file_exists("Music/" . $ArtistNoSpace . "/" . $AlbumNoSpace . "/" . $_FILES["file"]["name"]))
      {
        echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "Music/" . $ArtistNoSpace . "/" . $AlbumNoSpace . ".jpg");
      echo "Stored in: " . "Music/" . $ArtistNoSpace . "/" . $AlbumNoSpace . ".jpg" ." <br />";
      }
    }
  }
else
  {
  echo "Invalid file";
  }
  
$con=mysqli_connect("localhost","myrkurne","on8v/Vos785","myrkurne_Music");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="INSERT INTO Albums (Album, Artist, Label, Genre, Released, Link_Spotify, Link_SpotifyURI, Link_Youtube, Link_Soundcloud, Link_Other, Critique, Rating, PathToImage)
VALUES
('$Album','$Artist','$Label','$Genre','$Released','$Link_Spotify','$Link_SpotifyURI','$Link_Youtube','$Link_Soundcloud','$Link_Other','$Critique','$Rating','$PathToImage')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";

mysqli_close($con);
}
else
	echo "Computer says no.";
?> 