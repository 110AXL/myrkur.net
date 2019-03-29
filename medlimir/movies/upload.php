<!DOCTYPE html>
<html lang="en">
<head>
	<script src='https://www.google.com/recaptcha/api.js?render=6Le4LHsUAAAAAKwatXhyWMwqgwcoIG88JbmAXLas'></script>
    <meta charset="UTF-8">
    <title>Add a movie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
	<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '260449551282360');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=260449551282360&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:index.php");
}
// Include config file
require_once "medlimir/res/sqlcon.php";

$year = $link = $name = $user_id = "";

	/* Prepared statement, stage 2: bind and execute */
	$target_dir = "uploads/";
	$fileToUpload = $_FILES['fileToUpload']['name'];
	$target_file = $target_dir . basename($fileToUpload);
	$smol_file = $target_dir . "resize_" . basename($fileToUpload);
	$resized_file = $target_dir . "r_" . basename($fileToUpload);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$name = str_replace("'","",htmlspecialchars($_POST["movie"]));
$year = str_replace("'","",htmlspecialchars($_POST["year"]));
$link = htmlspecialchars($_POST["link"]);


//remove https replace with http on link1
if (strpos($link, 'https') !== false) {
     $link = substr_replace($link,NULL,4,1);
	 echo "https replaced with http on link 1.\n";
} else if(strpos($link, 'http://') === false) {
     $link = substr_replace($link,"http://",0,0);
	 echo "http added to link 1.\n";
}



// Define variables and initialize with empty values
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];



if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

/* Non-prepared statement
if (!$mysqli->query("DROP TABLE IF EXISTS test") || !$mysqli->query("CREATE TABLE test(id INT)")) {
    echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
} */

/* Prepared statement, stage 1: prepare */
if (!($stmt = $mysqli->prepare("INSERT INTO movies(name, year, link, img, user_id) VALUES (?,?,?,?,?)"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("ssssi", $name, $year, $link, $target_file, $user_id)) {
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

//Resize image function:
// for jpg
function resize_imagejpg($file, $w, $h) {
   list($width, $height) = getimagesize($file);
   $src = imagecreatefromjpeg($file);
   $dst = imagecreatetruecolor($w, $h);
   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
   return $dst;
}

 // for png
function resize_imagepng($file, $w, $h) {
   list($width, $height) = getimagesize($file);
   $src = imagecreatefrompng($file);
   $dst = imagecreatetruecolor($w, $h);
   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
   return $dst;
}

// for gif
function resize_imagegif($file, $w, $h) {
   list($width, $height) = getimagesize($file);
   $src = imagecreatefromgif($file);
   $dst = imagecreatetruecolor($w, $h);
   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
   return $dst;
}


	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists. ";
		$uploadOk = 0;
	}
	// Check file size
	if ($fileToUpload > 5000000) {
		echo "Sorry, your file is too large. ";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
		$uploadOk = 0;
	}
		// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename($fileToUpload). " has been uploaded. ";
		if (!copy($target_file, $smol_file)) {
			echo "failed to copy $file...\n";
			}
			else if($imageFileType == "jpg" || $imageFileType == "jpeg" ){
				echo "image is jpg or jpeg. \n";
				if(!$smol_file = resize_imagejpg($smol_file, 200, 200))
				echo "failed to JPG/JPEG resize $resized_file\n";
				else {
					imagejpeg($smol_file, $resized_file);
				}
			}
			else if($imageFileType == "png"){
				echo "image is png.\n";
				if(!$smol_file = resize_imagepng($smol_file, 200, 200))
				echo "failed to JPG/JPEG resize $resized_file\n";
				else {
					imagejpeg($smol_file, $resized_file);
				}
			}
			else if($imageFileType == "gif"){
				echo "image is gif.\n";
				if(!$smol_file = resize_imagegif($smol_file, 200, 200))
				echo "failed to JPG/JPEG resize $resized_file\n";
				else {
					imagejpeg($smol_file, $resized_file);
				}
			}

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
</body>
