<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134828746-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-134828746-1');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=260449551282360&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1><br/><h2><a href="addalbum.php">Add album</a><br/><a href="/movies/addmovie.php">Add movie</h2></a>
    </div>
    <p>
        <a href="/medlimir/reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="/medlimir/logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
<div class="container">
	<h2>Registered users:
  <div class="row">
	<?php 
	$servername = "localhost";
$username = "u445255185_zc4r";
$password = "AXL110axl";
$dbname = "u445255185_sweet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-sm'> <a href=/medlimir/?nafn=" .
     $row["username"]. ">" . $row["username"] . "</a></div>";
    }
} else {
    echo "0 results";
}
$conn->close();?>
  </div>
</div>
</body>
</html>