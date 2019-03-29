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
  require_once 'res/sqlcon.php';
  include 'res/ip.php';
  echo "<center>";
  include 'res/logo.php';
  echo "</center>";
  $year = date("Y");
  ?>

  </head>
  <body>
      <div class="wrapper">
          <h2>Tengja reikning</h2>
          <p>Hér getur þú tengt Twitch og Twitter við reikninginn þinn.</p>
  		    <div class="form-group" >
  		          <form action="social.php" method="post" enctype="multipart/form-data">

  		<label id="first">Twitch handle:</label><br/>
  		<input type="text" name="artist" placeholder="<?php echo $param_twitch ?>" id="twitch"><br/>
  	</div>
  	<div class="form-group" >
  		<label id="first">Twitter handle (With @):</label><br/>
  		<input type="text" name="album" placeholder="<?php echo $param_twitter ?>" id="twitter"><br/>
  	</div>
  				<input type="submit" value="submit" name="submit">
      </form>


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

<?php

// Define variables and initialize with empty values
$twitter = $param_twitter = $twitch = $param_twitch = "";

$username = $_SESSION['username'];
$userId = $_SESSION['id'];

/* Check if POST contains twitch url */
if(!empty($_POST['twitch']))
{
  if (substr($_POST['twitch']) 0, 9 == "twitch.tv") {
      echo "twitch.tv linked.";
      $twitchOk = 1;
  } elseif (substr($_POST['twitch']) 0, 13 == "www.twitch.tv") {
      echo "www.twitch.tv is linked";
      $twitchOk = 1;
  } elseif (substr($_POST['twitch']) 0, 20 == "http://www.twitch.tv") {
      echo "http://www.twitch.tv is linked";
      $twitchOk = 1;
  } elseif (substr($_POST['twitch']) 0, 21 == "https://www.twitch.tv") {
      echo "https://www.twitch.tv is linked";
      $twitchOk = 1;
  } else
    $twitchOk = 0;
}
if($twitchOk = 1){
    $stmt = $this->mysqli->prepare("UPDATE users SET twitch=? WHERE id=?");
  /* BK: always check whether the prepare() succeeded */
  if ($stmt === false) {
    trigger_error($this->mysqli->error, E_USER_ERROR);
    return;
  }
  $id = 1;
  /* Bind our params */
  /* BK: variables must be bound in the same order as the params in your SQL.
   * Some people prefer PDO because it supports named parameter. */
  $stmt->bind_param('si', $twitch, $id);

  /* Set our params */
  /* BK: No need to use escaping when using parameters, in fact, you must not,
   * because you'll get literal '\' characters in your content. */
  $twitch = $_POST['twitch'] ?: '';

  /* Execute the prepared Statement */
  $status = $stmt->execute();
  /* BK: always check whether the execute() succeeded */
  if ($status === false) {
    trigger_error($stmt->error, E_USER_ERROR);
  }
  printf("%d Row inserted.\n", $stmt->affected_rows);
}

/* Check if POST contains twitter url */
if(!empty($_POST['twitter']))
{
  if (substr($_POST['twitter']) 0, 11 == "twitter.com") {
      echo "twitter.com linked.";
      $twitterhOk = 1;
  } elseif (substr($_POST['twitter']) 0, 15 == "www.twitter.com") {
      echo "www.twitter.tv is linked";
      $twitterOk = 1;
  } elseif (substr($_POST['twitter']) 0, 22 == "http://www.twitter.com") {
      echo "http://www.twitter.com is linked";
      $twitterOk = 1;
  } elseif (substr($_POST['twitter']) 0, 23 == "https://www.twitter.com") {
      echo "https://www.twitter.com is linked";
      $twitterOk = 1;
  } else
    $twitterOk = 0;
}
if($twitterOk = 1){
    $stmt = $this->mysqli->prepare("UPDATE users SET twitter=? WHERE id=?");
  /* BK: always check whether the prepare() succeeded */
  if ($stmt === false) {
    trigger_error($this->mysqli->error, E_USER_ERROR);
    return;
  }
  $id = 1;
  /* Bind our params */
  /* BK: variables must be bound in the same order as the params in your SQL.
   * Some people prefer PDO because it supports named parameter. */
  $stmt->bind_param('si', $twitter, $id);

  /* Set our params */
  /* BK: No need to use escaping when using parameters, in fact, you must not,
   * because you'll get literal '\' characters in your content. */
  $twitter = $_POST['twitter'] ?: '';

  /* Execute the prepared Statement */
  $status = $stmt->execute();
  /* BK: always check whether the execute() succeeded */
  if ($status === false) {
    trigger_error($stmt->error, E_USER_ERROR);
  }
  printf("%d Row inserted.\n", $stmt->affected_rows);
}

?>
</div>
</body>
</html>
