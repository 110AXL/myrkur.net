 <!-- Example -->
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="./res/default.css">

<?php include('./res/facebookPixelCode.php'); ?>
<link rel="shortcut icon" type="image/png" href="main/favicon-16x16.png"/>
</head>
<body bgcolor="black">
 <?php
session_start();
include './res/ipgrabber.php';
include './res/sqlcon.php';
include './main/header.php';
include './res/logo.php';
echo "<div id='P'>";
    include './main/box.php';
echo "</div>";
echo "Thanks, man.";
?>
</body>
</html>
