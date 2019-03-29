 <!-- Example -->
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="medlimir/res/default.css">

<?php include('medlimir/res/facebookPixelCode.php'); ?>
<link rel="shortcut icon" type="image/png" href="main/favicon-16x16.png"/>
</head>
<body bgcolor="black">
 <?php
session_start();
require_once 'medlimir/res/sqlcon.php';
include 'medlimir/res/ip.php';
include 'main/header.php';
include 'medlimir/res/logo.php';
echo "<div id='P'>";
    include 'box.php';
echo "</div>";
echo "Thanks, man.";
?>
</body>
</html>
