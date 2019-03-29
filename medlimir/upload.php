<!DOCTYPE html>
<html lang="en">
<head>
	<script src='https://www.google.com/recaptcha/api.js?render=6Le4LHsUAAAAAKwatXhyWMwqgwcoIG88JbmAXLas'></script>
    <meta charset="UTF-8">
    <title>Add an album</title>
  	<link rel="stylesheet" type="text/css" href="../res/default.css">
		<style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
	<?php include('../res/facebookPixelCode.php'); ?>
</head>
<body>

<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:index.php");
}
include '../hidden/sqlcon.php';
include '../res/ipgrabber.php';
echo "<center>";
include '../res/logo.php';
echo "</center>";
echo "<p>Uploading file..</p><p>Genre: " . $_POST['genre'] . "</p>";

// Define variables and initialize with empty values
$artist = $album = $link1 = $link2 = $userId = $genre = $year = $data = $file = "";

$artist = str_replace("'","",htmlspecialchars($_POST["artist"]));
$album = str_replace("'","",htmlspecialchars($_POST["album"]));
$genre = $_POST["genre"];
$year = $_POST["year"];
$link1 = htmlspecialchars($_POST["link1"]);
$link2 = htmlspecialchars($_POST["link2"]);

$username = $_SESSION['username'];
$userId = $_SESSION['id'];

$targetDir = "uploads/";

/* Resize image function: */
/* for jpg */
function resize_imagejpg($file, $w, $h) {
   list($width, $height) = getimagesize($file);
   $src = imagecreatefromjpeg($file);
   $dst = imagecreatetruecolor($w, $h);
   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
   return $dst;
}

 /* for png */
function resize_imagepng($file, $w, $h) {
   list($width, $height) = getimagesize($file);
   $src = imagecreatefrompng($file);
   $dst = imagecreatetruecolor($w, $h);
   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
   return $dst;
}

/* for gif */
function resize_imagegif($file, $w, $h) {
   list($width, $height) = getimagesize($file);
   $src = imagecreatefromgif($file);
   $dst = imagecreatetruecolor($w, $h);
   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
   return $dst;
}

/* remove https replace with http on link1 */
if (strpos($link1, 'https') !== false) {
		$link1 = substr_replace($link1,NULL,4,1);
	 	echo "<p>https replaced with http on link 1.</p>";
	}
else if(strpos($link1, 'http://') === false) {
    $link1 = substr_replace($link1,"http://",0,0);
	 	echo "<p>http added to link 1.</p>";
}

/* remove https replace with http on link2 */
if (strpos($link2, 'https') !== false) {
     $link2 = substr_replace($link2,NULL,4,1);
	 echo "<p>https replaced with http on link 2.</p>";
	}
	else if(strpos($link2, 'http://') === false && $link2 != NULL) {
     $link2 = substr_replace($link2,"http://",0,0);
	 echo "<p>http added to link 2.</p>";
}

/* Prepared statement, stage 1: prepare */
if (!($stmt = $mysqli->prepare("INSERT INTO albums(artist, album, year, genre, link1, link2, img, user_id) VALUES (?,?,?,?,?,?,?,?)"))) {
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

/* Check if POST contains URL */
if(!empty($_POST['img_url']))
{

	$linkFileExt = strtolower(pathinfo($_POST['img_url'],PATHINFO_EXTENSION));
	$localUrl = $targetDir . $artist . "-" . $album . "." . $linkFileExt;
	$urlOk = 1;
	$resizedFilename = $targetDir . "r_" . basename($localUrl);
	$rImg = "r_" . basename($localUrl);

	/* Check if file exists */
	if(file_exists($localUrl)){
		echo "Sorry, file already exists. ";
		$urlOk = 0;
	}

	/* Check url size */
	if (file_get_contents($_POST['img_url']) > 5000000) {
		echo "Sorry, your url-file is too large. ";
		$urlOk = 0;
	}

	/* Allow certain file formats */
	if($linkFileExt != "jpg" && $linkFileExt != "png" && $linkFileExt != "jpeg"
	&& $linkFileExt != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF Urls are allowed. ";
		$urlOk = 0;
	}

	/* Check if $uploadOk is set to 0 by an error */
	if ($urlOk == 0) {
		echo "Sorry, your url-file was not uploaded.";
	}
	else if($urlOk == 1) {
		/* if everything is ok, try to upload file */
		echo "<b>Copying</b> " . $_POST['img_url'] . "<b> to </b>" . $localUrl . "<br/>";
		file_put_contents($localUrl, file_get_contents($_POST['img_url']));

		/* add url located info to MySQL server */
		if (!$stmt->bind_param("ssissssi", $artist, $album, $year, $genre , $link1, $link2, $rImg, $userId)) {
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		/* explicit close recommended */
		$stmt->close();

		/* Resize based on extension of link */
		if($linkFileExt == "jpg" || $linkFileExt == "jpeg" ){
			echo "image is jpg or jpeg. <br/>";
			if(!$localUrl = resize_imagejpg($localUrl, 200, 200))
				echo "failed to JPG/JPEG resize " . $localUrl . "<br/>";
			else {
				imagejpeg($localUrl, $resizedFilename);
				echo "Resized jpg/jpeg<br/>";
			}
		}
		else if($linkFileExt == "png"){
			echo "image is png.<br/>";
			if(!$localUrl = resize_imagepng($localUrl, 200, 200))
			echo "failed to png resize " .  $localUrl . "<br/>";
			else {
				imagejpeg($localUrl, $resizedFilename);
				echo "Resized png<br/>";
			}
		}
		else if($linkFileExt == "gif"){
			echo "image is gif.<br/>";
			if(!$localUrl = resize_imagegif($localUrl, 200, 200))
			echo "failed to gif resize " .  $localUrl . "<br/>";
			else {
				imagejpeg($localUrl, $resizedFilename);
				echo "Resized gif<br/>";
			}
		}

		/* Display: url uploaded */
		echo "Resized image: <br/><img src='" . $resizedFilename ."'><br/>";
		echo "<h1>" . $artist . " - " . $album . "</h1><br/>";
		if($uploadOk == 1) {
			echo "<pre>";
			print_r($_FILES);
			echo "</pre>";
		} else if($urlOk == 1) {
			echo "<pre>";
			print_r(file_get_contents($_POST['img_url']));
			echo "</pre>";
		}
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
    }
	}

else if(empty($_POST['img_url']) && !empty($_FILES['fileToUpload']['name']))
{

	/* Uploading the file if the url is empty */
	$localFilename = $targetDir . basename($_FILES['fileToUpload']['name']);
	$uploadOk = 1;
	$localFileExt = strtolower(pathinfo($localFilename,PATHINFO_EXTENSION));
	$resizedFilename = $targetDir . "r_" . basename($_FILES['fileToUpload']['name']);
	$rImg = "r_" . basename($_FILES['fileToUpload']['name']);

	/* Check if image file is a actual image or fake image */
	if(isset($_POST["submit"])) {
		$checkfile = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($checkfile !== false) {
			echo "File is an image - " . $checkfile["mime"] . ".<br/>";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}

	}

	// Check if file already exists
	if (file_exists($localFilename)) {
		echo "Sorry, file already exists. ";
		$uploadOk = 0;
	}

	/* Check uploaded file size */
	if ($_FILES['fileToUpload']['size'] > 5000000) {
		echo "Sorry, your file is too large. ";
		$uploadOk = 0;
	}

	/* Allow certain file formats */
	if($localFileExt != "jpg" && $localFileExt != "png" && $localFileExt != "jpeg"
	&& $localFileExt != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
		$uploadOk = 0;
	}

	/* Check if $uploadOk is set to 0 by an error */
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	}

	else	if($uploadOk == 1) {
		/* if everything is ok, try to upload file */
		if(!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $localFilename)) {
			echo "Failed to move uploaded file.";
		}
		else {
    		echo "The file " . basename($_FILES['fileToUpload']['name']) . " has been uploaded to " . $localFilename . ". <br/>";
		}

		/* Resize based on uploaded file extension: */
		if($localFileExt == "jpg" || $localFileExt == "jpeg" ){
			echo "image is jpg or jpeg and is being resized: <br/>";
			if(!$localFilename = resize_imagejpg($localFilename, 200, 200))
				echo "failed to JPG/JPEG resize" . $localFilename . "<br/>";
			else {
				imagejpeg($localFilename, $resizedFilename);
				echo "Resized jpg/jpeg<br/>";
			}
		}

		else if($localFileExt == "png"){
				echo "image is png. Resized:<br/>";
			if(!$localFilename = resize_imagepng($localFilename, 200, 200))
				echo "failed to png resize " . $localFilename . "<br/>";
			else {
				imagejpeg($localFilename, $resizedFilename);
				echo "Resized png<br/>";
			}
		}

		else if($localFileExt == "gif"){
				echo "image is gif.<br/>";
			if(!$localFilename = resize_imagegif($localFilename, 200, 200))
				echo "failed to gif resize " . $localFilename . "<br/>";
			else {
				imagejpeg($localFilename, $resizedFilename);
				echo "Resized gif<br/>";
			}
		}

		/* Add locally uploaded info to database */
		if (!$stmt->bind_param("ssissssi", $artist, $album, $year, $genre, $link1, $link2, $rImg, $userId)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		/* explicit close recommended */
		$stmt->close();
	}
		/* Display: Locally uploaded */
		echo "Resized image: <br/><img src='" . $resizedFilename ."'><br/>";
		echo "<h1>" . $artist . " - " . $album . "</h1><br/>";
		if($uploadOk == 1) {
			echo "<pre>";
			print_r($_FILES);
			echo "</pre>";
		} else if($urlOk == 1) {
			echo "<pre>";
			print_r(file_get_contents($_POST['img_url']));
			echo "</pre>";
		}
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
    }
		else {
    	echo "Sorry, there was an error uploading your file.";
		}


?>
</div>
</body>
</html>
