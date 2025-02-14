<?php
// add in the config file
require(__DIR__."/medlimir/config.php");
$loggedIn = 0;
if(!empty($_SESSION["loggedin"]))
{
  $loggedIn = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="shortcut icon" type="image/png" href="/medlimir/res/favicon.ico"/>
  <link rel="shortcut icon" type="image/png" href="http://myrkur.net/medlimir/res/favicon.ico"/>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>myrkur.net</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- load banner first of all -->
  <script type="text/javascript">
        if(document.images)
            (new Image()).src="img/spikesbg.jpg";
  </script>

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.css" rel="stylesheet">
  <link href="oldie.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- php includes -->
  <?php
    include(__DIR__.'/medlimir/res/ip.php');
    require_once 'main/sqlcon.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  ?>
  <div id="head" class="sticky">
  	<div id="bar">
      <div id="menu" class="sticky">
        <div class="link"><a class="nav-link js-scroll-trigger" href="mailto:system@myrkur.net">Contact</a></div>
        <div class="link"><a class="nav-link js-scroll-trigger" href="https://members.myrkur.net/">System</a></div>
        <div class="link"><a class="nav-link js-scroll-trigger" href="http://wiki.myrkur.net">Wiki</a></div>
        <div class="link"><a class="nav-link js-scroll-trigger" href="https://members.myrkur.net/addalbum.php">Add album</a></div>
      </div>
      <div id="logo" class="sticky">
          <a href="#page-top"><img src="oldie/img/myrkur-logo.jpg" /></a>
    </div>
  	</div>
  </div>
  <!-- Navigation -->

  <!-- <nav id="mainNav" class="navbar navbar-expand-lg navbar-light fixed-top py-3">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Myrkur.net</a>
      <button type="button" class="navbar-toggler collapsed navbar-toggler-right" data-toggle="collapse" data-target="#navBarResponsive" aria-controls="navBarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navBarResponsive">
          <ul class="navbar-nav ml-auto my-2 my-lg-0">
            <li class"nav-item">
              <a class="nav-link js-scroll-trigger" href="https://members.myrkur.net/addalbum.php">Add an album</a>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact & Wiki</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#portfolio">Albums</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="https://members.myrkur.net/">System</a>
            </li>
          </ul>
      </div>
    </div>
  </nav> -->

  <!-- Masthead -->
<!-- <header class="mast">
  <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-white font-weight-bold">☺ arr country ☺</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
            <p class="text-white-75 font-weight-light mb-5">pushing things forward</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="https://members.myrkur.net/addalbum.php">Add an album</a>
        </div>
      </div>
  </div>
</header> -->

  <!-- About Section
<section class="page-section bg-primary" id="about">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h2 class="text-white mt-0">We've got what you need!</h2>
            <hr class="divider light my-4">
            <p class="text-white-50 mb-5">ProgrammingKnowledge has everything you need to get you started! Browse our awesome collection of video tutorials!</p>
            <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Get Started!</a>
        </div>
    </div>
  </div>
</section> -->

  <!-- Services Section
<section class="page-section" id="services">
  <div class="container">
    <h2 class="text-center mt-0">Music Album Galore</h2>
    <hr class="divider my-4">
    <div class="row">
      <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <a href="http://myrkur.net/?clicks#albums">
              <i class="fas fa-4x fa-gem text-primary mb-4"></i>
              <h3 class="h4 mb-2">Rare Albums</h3>
              <p class="text-muted mb-0">High quality music for FREE!</p>
            </a>
          </div>
      </div>

      <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
              <a href="http://myrkur.net/?released#albums">
                <i class="fas fa-4x fa-laptop-code text-primary mb-4"></i>
                <h3 class="h4 mb-2">Up to Date</h3>
                <p class="text-muted mb-0">New releases added weekly</p>
              </a>
          </div>
      </div>

      <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <a href="http://myrkur.net/?added#albums">
              <i class="fas fa-4x fa-globe text-primary mb-4"></i>
              <h3 class="h4 mb-2">Open to All</h3>
              <p class="text-muted mb-0">Anyone can add an album.</p>
            </a>
          </div>
      </div>


      <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <a href="http://myrkur.net/?artist#albums">
              <i class="fas fa-4x fa-heart text-primary mb-4"></i>
              <h3 class="h4 mb-2">Made to Share</h3>
              <p class="text-muted mb-0">Anyone can create a collection.</p>
            </a>
          </div>
      </div>
    </div>
  </div>
</section>

   Portfolio Section -->
<section id="portfolio">
  <div class="container-fluid p-0">
        <div class="row no-gutters">
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
         echo "<div class='col-lg-3 col-sm-3'>";
          echo "<a class='portfolio-box' target=_blank title='" . $row["artist"]. " - " . $row["album"]. " [" . $row["username"] . "]' href=main/link.php?i='" . $row["id"]."' alt='" . $row["album"] . " by- " . $row["artist"] . "'>";
          echo "<img class='img-fluid' height='100%' width='100%' src='/medlimir/uploads/" . $removed_spaces . "' alt=''>";
          echo "<div class='portfolio-box-caption'>";
            echo "<div id='artist'><h1>" . $row["artist"] . "</div>";
              echo "<div id='album'>" . $row["album"] . "<h1></div></div></a></div>";
         // echo "<p class='info' title='Year & link clicks.'><a href=main/link.php?i='" . $row["id"]."'>" . $row["year"] . "</a></p><div id=username>" . $row["username"] . "</div><div id=clicks>" . $row["clicks"] . "</div></div>";
         }
       }

      $mysqli->close();?>
    <!-- Default shit
        <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/1.jpg" >
            <img class="img-fluid" src="img/portfolio/fullsize/1.jpg" alt="">
            <div class="portfolio-box-caption">
              <div class="project-category text-white-50">
                Category
              </div>
              <div class="project-name">
                Project Name
              </div>

            </div>
            </a>
        </div>


        <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/2.jpg" alt="">
            <img class="img-fluid" src="img/portfolio/fullsize/2.jpg" alt="">
            <div class="portfolio-box-caption">
              <div class="project-category text-white-50">
                Category
              </div>
              <div class="project-name">
                Project Name 2
              </div>

            </div>
            </a>
        </div>
        <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/3.jpg" alt="">
            <img class="img-fluid" src="img/portfolio/fullsize/3.jpg" alt="">
            <div class="portfolio-box-caption">
              <div class="project-category text-white-50">
                Category
              </div>
              <div class="project-name">
                Project Name 3
              </div>

            </div>
            </a>
        </div>
        <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/4.jpg" alt="">
            <img class="img-fluid" src="img/portfolio/fullsize/4.jpg" alt="">
            <div class="portfolio-box-caption">
              <div class="project-category text-white-50">
                Category
              </div>
              <div class="project-name">
                Project Name 4
              </div>

            </div>
            </a>
        </div>

        <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/5.jpg" alt="">
            <img class="img-fluid" src="img/portfolio/fullsize/5.jpg" alt="">
            <div class="portfolio-box-caption">
              <div class="project-category text-white-50">
                Category
              </div>
              <div class="project-name">
                Project Name 5
              </div>

            </div>
          </a>
        </div>

        <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="img/portfolio/fullsize/6.jpg" alt="">
            <img class="img-fluid" src="img/portfolio/fullsize/6.jpg" alt="">
            <div class="portfolio-box-caption">
              <div class="project-category text-white-50">
                Category
              </div>
              <div class="project-name">
                Project Name 6
              </div>

            </div>
          </a>
        </div> -->
    </div>

  </div>

</section>
  <!-- Call to Action Section
<section class="page-section bg-dark text-white">
  <div class="container text-center">
    <h2 class="mb-4">Free Music Albums</h2>
    <hr class="divider light my-4">
    <p class="text-white-50 mb-4">You can have High Quality Music Albums for absolutely FREE!</p>
    <a class="btn btn-light btn-xl" href="https://www.slsknet.org/news/">Download Now!</a>
  </div>
</section>

   Contact Section -->
<!-- <section class="page-section" id="contact">
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h2 class="mt-0">About</h2>
            <hr class="divider my-4">
            <p class="text-muted mb-5">Contact information & wiki</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <a class="d-block" href="http://wiki.myrkur.net">wiki.myrkur.net</a>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <a class="d-block" href="mailto:system@myrkur.net">system@myrkur.net</a>
        </div>
      </div>
  </div>
</section>

  <!-- Footer -->
<footer class="bg-light py-5">
  <div class="container">
      <div class="small text-center text-muted">
          © original pirate material
      </div>
  </div>
</footer> -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/creative.js"></script>

</body>

</html>
