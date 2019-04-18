<!DOCTYPE html>
<html lang="en">
<head>
	<script src='https://www.google.com/recaptcha/api.js?render=6Le4LHsUAAAAAKwatXhyWMwqgwcoIG88JbmAXLas'></script>
    <meta charset="UTF-8">
    <title>Tengja reikning</title>
  	<link rel="stylesheet" type="text/css" href="/res/default.css">
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
  $year = date("Y");
  ?>

  </head>
  <body>
		<div class="container">
		  <header>
		    <?php include(__DIR__.'/res/logo.html');?>
		  </header>

		  <nav>
		       <?php include(__DIR__.'/res/navbar.php');?>
		  </nav>

		  <main>
          <h2>Update connections</h2>
          <p>Here you can update your connections.</p>
  		    <div class="form-group" >

  		      <form action="socialupdate.php" method="post" enctype="multipart/form-data">
							<ul>
				  		<label id="twitch">Twitch handle:</label><br/>
				  		<li><input type="text" name="twitch" id="twitch"><br/></li>
				  		<label id="twitter">Twitter handle (Without @):</label><br/>
				  		<li><input type="text" name="twitter" id="twitter"><br/></li>
							<label id="discord">Discord handle (username#0000):</label><br/>
							<li><input type="text" name="discord" id="discord"><br/></li>
							<label id="youtube">Youtube channel (with http:// or https://):</label><br/>
							<li><input type="text" name="youtube" id="youtube"><br/></li>
							<label id="psn">Playstation Network username:</label><br/>
							<li><input type="text" name="psn" id="psn"><br/></li>
							<label id="email">Email address:</label><br/>
							<li><input type="text" name="email" id="email"><br/></li>

								<label id="password">Please enter your password to continue.</label>
								<li><input type='password' name='password' id="password"></li>

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
