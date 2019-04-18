<?php
// add in the config file
require(__DIR__."/config.php");
$loggedIn = 0;
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
  $loggedIn = 1;
  echo "logged in";
}
/*
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $loggedIn = 0;
     echo "not logged in.<br/>";
} if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
   $loggedIn = 1;
   echo "logged in.<br/>";
}*/
?>
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href='<?php echo __DIR__;?>/res/default.css'>
<?php
  include(__DIR__.'res/facebookPixelCode.php');
?>
<link rel="shortcut icon" type="image/png" href='<?php echo __DIR__;?>/res/favicon-16x16.png'/>
<script src="res/jquery-3.4.0.min.js">
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
  include(__DIR__.'/res/ip.php');
  require_once 'main/sqlcon.php';
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  ?>
<div class="container">
  <header>
    <?php include(__DIR__.'res/logo.html');?>
  </header>

  <nav>
   <ul>
     <li>
      <label for="sortBy-toggle">Sort by:</label>
       <input type="checkbox" id="sortBy-toggle">
         <ul id="sortBy">
           <li><a href="?artist">Artist</a></li>
           <li><a href="?added">Date added</a></li>
           <li><a href="?released">Date released</a></li>
           <li><a href="?clicks">Clicks</a></li>
           <li><a href="?user">User</a></li>
         </ul>
       </input>
     </li>
     <label for="membership-toggle">Membership:</label>
      <input type="checkbox" id="membership-toggle">
        <ul id="membership">
          <?php if($loggedIn == 0){
          echo "<li><a href=http://members.myrkur.net>Login</a></li>";
          echo "<li><a href=http://members.myrkur.net/register.php/>Register</a></li>";
        } else if($loggedIn = 1){
          echo "<li><a href=http://members.myrkur.net/welcome.php>Profile</a></li>";
          echo "<li><a href=http://members.myrkur.net/addalbum.php>Add album</a></li>";
        } ?>
        </ul>
      </input>
   </ul>
  </nav>

  <main>
    <div id='P'>
      <div class='grid-container grid-container--fill'>
      <?php

        switch($_SERVER['QUERY_STRING']) {
            case 'user':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY users.username DESC";
                break;
            case 'artist':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.artist DESC";
                break;
            case 'added':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.created_at DESC";
                break;
            case 'released':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.year DESC";
                break;
            case 'clicks':
                $sql = "SELECT albums.id, albums.clicks, albums.artist, albums.year, albums.created_at, albums.album, albums.link1, albums.img, users.username FROM albums LEFT JOIN users ON albums.user_id = users.id ORDER BY albums.clicks DESC";
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
           echo "<img width=200 height=200 src=members/uploads/" . $removed_spaces . " />";
           echo "<div class='title'><p>" . $row["artist"] . " - " . $row["album"] . "</a></p></div>";
           echo "<p class='info' title='Year & link clicks.'><a href=main/link.php?i='" . $row["id"]."'>" . $row["year"] . "</a></p><div id=username>" . $row["username"] . "</div><div id=clicks>" . $row["clicks"] . "</div></div>";
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
