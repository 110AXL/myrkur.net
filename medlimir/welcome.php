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
<?php include('../res/facebookPixelCode.php'); ?>
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
    include './hidden/sqlcon.php';

$sql = "SELECT username, email, twitch FROM users ORDER BY twitch, username ASC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-sm'> <a href=/medlimir/?nafn=" .
     $row["username"]. "><h2>" . $row["username"] . "</h2></a> <a href=mailto:" . $row["email"] . "><h3>" . $row["email"] . "</h3></a>";
     if(!empty($row["twitch"]))
       echo " <a href=" . $row["twitch"] . "<img src='../res/Twitch_White_RGB.png' /></a>";
     echo"</div>";
    }
} else {
    echo "0 results";
}
$mysqli->close();?>
  </div>
</div>
</body>
</html>
