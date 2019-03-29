<!DOCTYPE html>
<html lang="en">
<head>
	<script src='https://www.google.com/recaptcha/api.js?render=6Le4LHsUAAAAAKwatXhyWMwqgwcoIG88JbmAXLas'></script>
    <meta charset="UTF-8">
    <title>Tengja reikning</title>
  	<link rel="stylesheet" type="text/css" href=".res/default.css">
		<style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
	<?php include('res/facebookPixelCode.php'); ?>
</head>
<body>


  <?php
  session_start();
  if(!isset($_SESSION['username'])){
     header("Location:index.php");
  }
	include 'sqlcon.php';
  include 'res/ip.php';
  echo "<center>";
  include 'res/logo.html';
  echo "</center>";
  $year = date("Y");
  ?>

  </head>
  <body>
      <div class="wrapper">
          <h2>Tengja reikning</h2>
          <p>Hér getur þú tengt Twitch og Twitter við reikninginn þinn.</p>
  		    <div class="form-group" >
  		      <form action="socialupdate.php" method="post" enctype="multipart/form-data">

				  		<label id="twitch">Twitch handle:</label><br/>
				  		<input type="text" name="artist" id="twitch"><br/>
				  		<label id="twitter">Twitter handle (With @):</label><br/>
				  		<input type="text" name="album" id="twitter"><br/>

	  					<input type="submit" value="submit" name="submit">
      			</form>
				 </div>


  			 <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
  				  <script>
  				  grecaptcha.ready(function() {
  					  grecaptcha.execute('reCAPTCHA_site_key', {action: 'homepage'}).then(function(token) {
  						 ...
  					  });
  				  });
  			 </script>
          </form>
      </div>
</div>
</body>
</html>
