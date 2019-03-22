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

// Include config file
require_once "medlimir/config.php";
include 'sqlcon.php';

$mysqli = new mysqli("localhost", "u445255185_zc4r", "AXL110axl", "u445255185_sweet");
$year = $link = $name = $user_id = "";

if (isset($_GET['i']))
{
	$i = htmlspecialchars($_GET["i"]);
}
$sql = "SELECT link1, clicks FROM albums WHERE id =" . $i;

$result = $conn->query($sql);


if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
		$clicks = $row["clicks"] + 1;
		
		$sql2 = "UPDATE albums SET clicks=" . $clicks . " WHERE id=" . $i;

		if ($conn->query($sql2) === TRUE) {
			echo $clicks;
		} else {
			echo "Error updating record: " . $conn->error;
		}
		header("location: " . $row["link1"]);
	} 
}



$conn->close();

if(isset($link) === FALSE){ 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
header("location: welcome.php");
exit;
	}
	else{
		header("location: index.php");
	}
}

?>
</body>