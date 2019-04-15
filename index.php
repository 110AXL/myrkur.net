<!-- Example -->
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="medlimir/res/default.css">
<link href="main/nav/lazeemenu.css" rel="stylesheet">
<?php
  include('medlimir/res/facebookPixelCode.php');
?>
<link rel="shortcut icon" type="image/png" href="main/favicon-16x16.png"/>
<script src="jquery-3.3.1.min.js">
$(document).ready(function() {
  $('nav li ul').hide().removeClass('fallback');
    $('nav li').hover(
      function () {
        $('ul', this).stop().slideDown(100);
      },
      function () {
        $('ul', this).stop().slideUp(100);
      }
    );
});</script>
</head>
<body bgcolor="black">
<?php
  session_start();
  include 'medlimir/res/ip.php';
  require_once 'main/sqlcon.php';
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  ?>
<div class="container">
  <header>
    <?php include 'medlimir/res/logo.html';?>
  </header>

  <nav>
    <?php include 'main/nav.php'?>
  </nav>

  <main>
    <div id='P'>
      <div class='grid-container grid-container--fill'>
      <?php

        $sql = "SELECT albums.id, albums.artist, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.id DESC";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
           $resized_link = $row["img"];
           $removed_spaces = str_replace(" ","%20",$resized_link);
           echo "<div class='grid-element'><a target=_blank title='" . $row["artist"]. " - " . $row["album"]. " [" . $row["username"] . "]' href=main/link.php?i='" . $row["id"]."'><img width=200 height=200 src=medlimir/uploads/" . $removed_spaces . " /><div class='title'><p>" . $row["artist"] . " - " . $row["album"] . "</a></div></p></div>";
           }
         }

        $mysqli->close();?>
      </div>
    </div>
  </main>

  <aside>
    <!-- Sidebar / Ads -->
  </aside>

  <footer>
    <!-- Footer content -->
  </footer>
</div>
</body>
</html>
