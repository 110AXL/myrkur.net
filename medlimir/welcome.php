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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
<?php include('res/facebookPixelCode.php'); ?>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1><br/><h2><a href="addalbum.php">Add album</a><br/><a href="/movies/addmovie.php">Add movie</h2></a>
    </div>
    <p>
        <a href="/reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="/logout.php" class="btn btn-danger">Log Out of Your Account</a>
    </p>
<div class="container">
	<h2>Registered users:
  <div class="row">
	<?php
require_once 'res/sqlcon.php';

$sql = "SELECT username, email, twitter, twitch FROM users ORDER BY username, twitter, twitch  ASC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data of each row<div class="w3-container">
  echo "<h2>Userlist</h2>

  <table class='w3-table-all w3-hoverable'>
    <thead>
      <tr class='w3-light-grey'>
        <th>Username</th>
        <th>Email</th>
        <th>Twitter & Twitch</th>
      </tr>
    </thead>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td><a href=/medlimir/?nafn=" . $row["username"]. ">" . $row["username"] . "</a>";
        echo "<td><a href=mailto:" . $row["email"] . ">" . $row["email"] . "</a></td>";
     if(!empty($row["twitter"]))
       echo "<td class='twitterIcon'><a href=http://twitter.com/" . $row["twitter"] . "><img src='res/Twitter_Logo_Blue.png' class='icon' /></a>";
     if(!empty($row["twitch"])){
       echo " ";
       echo "<td class='twitchIcon'><a href=http://twitch.tv/" . $row["twitch"] . "><img src='res/Glitch_Purple_RGB.png' class='icon' /></a></td>";
     }
     echo "<tr></div>";
    }
} else {
    echo "0 results";
}
$mysqli->close();?>
  </div>
</div>
</body>
</html>
