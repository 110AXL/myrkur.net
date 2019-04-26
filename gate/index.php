<!-- Example -->
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="../medlimir/res/default.css">

<?php include(__DIR__.’../medlimir/res/facebookPixelCode.php'); ?>
<link rel="shortcut icon" type="image/png" href="../medlimir/res/favicon-16x16.png"/>
</head>
<body bgcolor="black">
<?php
session_start();
include (__DIR__.’../medlimir/res/ip.php');
?>
<div class="container">
  <header>
      <?php include(__DIR__.'../medlimir/res/logo.html');?>
  </header>

  <nav>
    <!-- Navigation -->
    <?php include (__DIR__.’../medlimir/navbar.php';?>
  </nav>

  <main><ul>
    <h2>Podcasts:</h2>
      <li><a href='https://snorribjorns.libsyn.com/'>The Snorri Björns Podcast Show</a></li>
      <li><a href='https://player.fm/series/filalag'>Fílalag</a></li>
      <li><a href='https://www.podparadise.com/Podcast/1300530703'>Markmannshanskarnir hans Alberts Camus</a></li>
      <li><a href='https://www.podbean.com/podcast-detail/qnr4h-68197/%C3%86vint%C3%BDri-Tinna-Podcast'>Ævintýri Tinna</a></li>
      <li><a href='https://soundcloud.com/user-145983845'>Helgaspjallið</a></li>
      <li><a href='https://soundcloud.com/hj-rvar-hafli-ason'>Dr. Football Podcast</a></li>
      <li><a href='https://fotbolti.net/radio.php'>Fótbolti.net</a></li>
      <li><a href='http://www.kop.is/gamalt/podcast/'>Gullkastið</a></li>
      <li><a href='https://soundcloud.com/kjarninn/sets/hismid'>Hismið</a></li>
      <li><a href='https://soundcloud.com/kjarninn/sets/kvikan'>Kvikan</a></li>
      <li><a href='https://soundcloud.com/kjarninn/sets/ukl'>Þukl</a></li>
      <li><a href='https://soundcloud.com/kjarninn/sets/grettistak'>Grettistak</a></li>
      <li><a href='https://soundcloud.com/kjarninn/sets/taeknivarpi'>Tæknivarpið</a></li>
      <li><a href='https://player.fm/series/grinland'>Grínland</a></li>
    </ul>
    <ul>
    <h2>Sports:</h2>
      <li><a href='https://stats.nba.com/schedule/'>NBA Schedule</a></li>
      <li><a href='https://footyroom.com/'>Footyroom</a></li>
      <li><a href='https://www.livescore.com/'>Livescore</a></li>
      <li><a href='https://firstsrowsports.tv'>Firstrow Sports</a></li>
    </ul><ul>
    <h2>TV & Movies</h2>
      <li><a href='http://vumoo.to/'>Vumoo</a></li>
      <li><a href='https://www11.fmovies.io/'>F Movies</a></li>
      <li><a href='http://vexmovies.org'>Vex Movies</a></li>
      <li><a href='https://gostream.site'>Go Stream</a></li>
      <li><a href='https://movieninja.io'>Movie Ninja</a></li>
    </ul>
  <aside>
    <!-- Sidebar / Ads -->
  </aside>

  <footer>
    <!-- Footer content -->
  </footer>
</div>
</body>
</html>
