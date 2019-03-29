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

  		      <form action="social.php" method="post" enctype="multipart/form-data">

				  		<label id="twitch">Twitch handle:</label><br/>
				  		<input type="text" name="twitch" id="twitch"><br/>
				  		<label id="twitter">Twitter handle (With @):</label><br/>
				  		<input type="text" name="twitter" id="twitter"><br/>

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
<?php
// Define variables and initialize with empty values
$twitter = $param_twitter = $twitch = $param_twitch = "";
$id = $_SESSION['id'];


/* Check if POST contains twitch url */
if(isset($_POST['twitch']))
{
	$twitch = $_POST['twitch'];
	echo $twitch;

  $stmt = $mysqli->prepare("UPDATE users SET twitch=? WHERE id=?");
  /* BK: always check whether the prepare() succeeded */
  if ($stmt === false) {
    trigger_error($mysqli->error, E_USER_ERROR);
    return;
  }
  /* Bind our params */
  /* BK: variables must be bound in the same order as the params in your SQL.
   * Some people prefer PDO because it supports named parameter. */
  $stmt->bind_param('si', $twitch, $id);

  /* Set our params */
  /* BK: No need to use escaping when using parameters, in fact, you must not,
   * because you'll get literal '\' characters in your content. */
/*  $twitch = $_POST['twitch'] ?: '';*/

  /* Execute the prepared Statement */
  $status = $stmt->execute();
  /* BK: always check whether the execute() succeeded */
  if ($status === false) {
    trigger_error($stmt->error, E_USER_ERROR);
  }
  printf("stmt %d Row inserted.\n", $stmt->affected_rows);
}

/* Check if POST contains twitter url */
if(isset($_POST['twitter']))
{
	$twitter = $_POST['twitter'] ?: '';

  $stmt2 = $mysqli2->prepare("UPDATE users SET twitter=? WHERE id=?");
  /* BK: always check whether the prepare() succeeded */
  if ($stmt2 === false) {
    trigger_error($mysqli2->error, E_USER_ERROR);
    return;
  }
  /*$id = 1;*/
  /* Bind our params */
  /* BK: variables must be bound in the same order as the params in your SQL.
   * Some people prefer PDO because it supports named parameter. */
  $stmt2->bind_param('si', $twitter, $id);

  /* Set our params */
  /* BK: No need to use escaping when using parameters, in fact, you must not,
   * because you'll get literal '\' characters in your content. */
/*  $twitter = $_POST['twitter'] ?: '';*/


  /* Execute the prepared Statement */
  $status2 = $stmt2->execute();
  /* BK: always check whether the execute() succeeded */
  if ($status2 === false) {
    trigger_error($stmt2->error, E_USER_ERROR);
  }
  printf("stmt2 %d Row inserted.\n", $stmt2->affected_rows);
} else echo "No Post";

?>

</body>
</html>
