<!-- Example -->
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="medlimir/res/default.css">
<link href="main/nav/lazeemenu.css" rel="stylesheet">
<?php
  include('medlimir/res/facebookPixelCode.php');
?>
<link rel="shortcut icon" type="image/png" href="medlimir/res/favicon-16x16.png"/>
<script src="jquery-3.3.1.min.js">
$(document).ready(function() {
  $('nav li ul').hide().removeClass('fallback');
    $('nav li').hover(
      function () {
        $('ul', this).stop().slideDown(1111);
      },
      function () {
        $('ul', this).stop().slideUp(1111);
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
   <ul>
     <li><a href="http://members.myrkur.net">Members</a></li>
     <li>
      <label for="menu-toggle">Sort by:</label>
       <input type="checkbox" id="menu-toggle"/>
       <ul id="menu" class="fallback">
         <li><a href="?artist">Artist</a></li>
         <li><a href="?album">Album name</a></li>
         <li><a href="?added">Date added</a></li>
         <li><a href="?released">Date released</a></li>
         <li><a href="?clicks">Clicks</a></li>
         <li><a href="?user">User</a></li>
       </ul>
       <div id='content'>Below content<div/>
     </li>
   </ul>


   <input type="checkbox" id="menu-toggle"/>
   <ul id="menu">
     <li><a href="#">Item 1</a></li>
     <li><a href="#">Item 2</a></li>
     <li><a href="#">Item 3</a></li>
   </ul>
   <div id='content'>Below content<div/>
  </nav>

  <main>
    <div id='P'>
      <div class='grid-container grid-container--fill'>
      <?php

        switch($_SERVER['QUERY_STRING']) {
            case 'user':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY users.id";
                break;
            case 'artist':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.artist";
                break;
            case 'added':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.created_at";
                break;
            case 'released':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.year";
                break;
            case 'clicks':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.clicks";
                break;
            case 'album':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.album";
                break;

            default:
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.id DESC";
        }

        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
           $resized_link = $row["img"];
           $removed_spaces = str_replace(" ","%20",$resized_link);
           echo "<div class='grid-element'><a target=_blank title='" . $row["artist"]. " - " . $row["album"]. " [" . $row["username"] . "]' href=main/link.php?i='" . $row["id"]."'>";
           echo "<img width=200 height=200 src=medlimir/uploads/" . $removed_spaces . " />";
           echo "<div class='title'><p>" . $row["artist"] . " - " . $row["album"] . "</a></p></div>";
           echo "<p>" . $row["year"] . " [" . $row["username"] . "] (" . $row["clicks"] . ")</div>";
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
