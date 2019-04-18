<?php
// add in the config file
require($_SERVER['DOCUMENT_ROOT']."/config.php");

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
<?php include(__DIR__.'/res/facebookPixelCode.php'); ?>
</head>
<body>
  <div id="buttons">
    <p style='float: left; color: #e1e114; padding: 20px; margin: 10px;'><a href="/reset-password.php">Reset password</a></p>
    <p style='float: right;color: #89a203; padding: 20px; margin: 10px;'><a href="/logout.php">Log out</a></p>
  </div>
  <?php include(__DIR__.'/res/logo.html'); ?>
    <div>
        <p style='font-family: Times New Roman, Times, serif;'><h1>Welcome <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> to the mainframe</h1></p>
        <p style='font-family: Verdana, Verdana, sans-serif;'><h2><a href="addalbum.php">Add album</a><br/></p>
        <p><a href="/social.php">Update connections</h2></a></p>
    </div>
  <?php
require_once (__DIR__.'/res/sqlcon.php');

$sql = "SELECT username, email, twitter, twitch, psn, discord, youtube FROM users ORDER BY twitch DESC, twitter DESC, username ASC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
  echo "<div class='w3-container'>
    <h2>Current members:</h2>
  <table class='w3-table-all w3-hoverable'>
    <thead>
      <tr class='w3-light-grey'>
        <th>Username</th>
        <th>Email</th>
        <th>Connections</th>
      </tr>
    </thead>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td style='font-family: Lucida Console;'><a href=/?nafn=" . $row["username"]. ">" . $row["username"] . "</a>";
        echo "<td style='font-family: Courier New, Courier, Monospace;'><a href=mailto:" . $row["email"] . ">" . $row["email"] . "</a></td>";
        echo "<td>";
     if(!empty($row["twitch"]))
       echo "<a href=http://twitch.tv/" . $row["twitch"] . "><img src='res/Glitch_Purple_RGB.png' style='width:21px;height:21px;' /></a>";
     if(!empty($row["twitter"])){
       echo " ";
       echo "<a href=http://twitter.com/" . $row["twitter"] . "><img src='res/Twitter_Logo_Blue.png' style='width:21px;height:21px;' /></a>";
     }
     if(!empty($row["youtube"])){
       echo " ";
       echo "<a href=" . $row["youtube"] . "><img src='res\youtube_social_square_red.png' style='width:21px;height:21px;' /></a>";
     }
     if(!empty($row["discord"])){
       echo " ";
       echo "<img src='res/Discord-Logo-Color.png' style='width:21px;height:21px;' />:" . $row["discord"] . " ";
     }
     if(!empty($row["psn"])){
       echo " ";
       echo "<img src='res\playstation-logo.png' style='width:21px;height:21px;' />:" . $row["psn"];
     }
     echo "</td><tr></div>";
    }
} else {
    echo "0 results";
}
$mysqli->close();?>
  </div>
</div>
</body>
</html>
