 <!-- Example -->
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="http://myrkur.net/res/default.css">

<?php include('http://myrkur.net/res/facebookPixelCode.php'); ?>
<link rel="shortcut icon" type="image/png" href="main/favicon-16x16.png"/>
</head>
<body bgcolor="black">
 <?php
session_start();
include 'http://myrkur.net/res/ipgrabber.php';
include 'http://myrkur.net/res/sqlcon.php';
include 'http://myrkur.net/main/header.php';
include 'http://myrkur.net/res/logo.php';
echo "<div id='P'>";
    include 'http://myrkur.net/main/box.php';
echo "</div>";
echo "Thanks, man.";
?>
</body>
</html>
