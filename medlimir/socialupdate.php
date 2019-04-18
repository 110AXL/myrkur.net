<?php
session_start(); ?>
<!-- Example -->
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="/res/default.css">

<?php include('/res/facebookPixelCode.php'); ?>
<link rel="shortcut icon" type="image/png" href="/res/favicon-16x16.png"/>
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
      <?php
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$id = $_SESSION['id'];

// Define variables and initialize with empty values
$twitter = $youtube = $twitch = $psn = $email = $discord = $passi= "";


if(empty(trim($_POST["password"]))){
		$password_err = "Please enter your password.";
} else{
		$password = trim($_POST["password"]);
}

if(empty($password_err)){
			include "sqlcon.php";
			// Prepare a select statement
			$sql = "SELECT id, password FROM users WHERE id = ?";

			if($state = mysqli_prepare($mysqli, $sql)){
					// Bind variables to the prepared statement as parameters
					mysqli_stmt_bind_param($state, "s", $param_id);

					// Set parameters
					$param_id = $id;

					// Attempt to execute the prepared statement
					if(mysqli_stmt_execute($state)){
							// Store result
							mysqli_stmt_store_result($state);

							// Check if username exists, if yes then verify password
							if(mysqli_stmt_num_rows($state) == 1){
									// Bind result variables
									mysqli_stmt_bind_result($state, $id, $hashed_password);
									if(mysqli_stmt_fetch($state)){
											if(password_verify($password, $hashed_password)){
													// Password is correct, update the database

													{

														/* Check if POST contains twitch url */
														if(isset($_POST['twitch']))
														{
															$twitch = $_POST['twitch'];
															echo "<p>Twitch account set to: ". $twitch ."</p>";

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
														  printf("<p>Twitch %d Row inserted.</p>\n", $stmt->affected_rows);
														}

														/* Check if POST contains discord username */
														if(isset($_POST['discord']))
														{
															$discord = $_POST['discord'];
															echo "<p>Discord account set to: ". $discord ."</p>";

														  $stmt = $mysqli->prepare("UPDATE users SET discord=? WHERE id=?");
														  /* BK: always check whether the prepare() succeeded */
														  if ($stmt === false) {
														    trigger_error($mysqli->error, E_USER_ERROR);
														    return;
														  }
														  /* Bind our params */
														  /* BK: variables must be bound in the same order as the params in your SQL.
														   * Some people prefer PDO because it supports named parameter. */
														  $stmt->bind_param('si', $discord, $id);

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
														  printf("<p>Discord %d Row inserted.</p>\n", $stmt->affected_rows);
														}

														/* Check if POST contains Playstation network username */
														if(isset($_POST['psn']))
														{
															$psn = $_POST['psn'];
															echo "<p>Playstation Network account set to: ". $psn ."</p>";

														  $stmt = $mysqli->prepare("UPDATE users SET psn=? WHERE id=?");
														  /* BK: always check whether the prepare() succeeded */
														  if ($stmt === false) {
														    trigger_error($mysqli->error, E_USER_ERROR);
														    return;
														  }
														  /* Bind our params */
														  /* BK: variables must be bound in the same order as the params in your SQL.
														   * Some people prefer PDO because it supports named parameter. */
														  $stmt->bind_param('si', $psn, $id);

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
														  printf("<p>Playstation Network %d Row inserted.</p>\n", $stmt->affected_rows);
														}

														/* Check if POST contains Youtube channel */
														if(isset($_POST['youtube']))
														{

															if(substr(trim($_POST["youtube"]), 0, 23) == "https://www.youtube.com"){
													        $youtube = trim($_POST["youtube"]);
													    } else if (substr(trim($_POST["youtube"]), 0, 22) == "http://www.youtube.com")
													      {
													        $youtube = trim($_POST["youtube"]);
													    } else if (substr(trim($_POST["youtube"]), 0, 19) == "https://youtube.com")
													      {
													        $youtube = trim($_POST["youtube"]);
													    } else if (substr(trim($_POST["youtube"]), 0, 18) == "http://youtube.com")
													      {
													        $youtube = trim($_POST["youtube"]);
													    } else {
													        $youtube = "#";
													    }

															echo "<p>Youtube channel set to: ". $youtube ."</p>";

														  $stmt = $mysqli->prepare("UPDATE users SET youtube=? WHERE id=?");
														  /* BK: always check whether the prepare() succeeded */
														  if ($stmt === false) {
														    trigger_error($mysqli->error, E_USER_ERROR);
														    return;
														  }
														  /* Bind our params */
														  /* BK: variables must be bound in the same order as the params in your SQL.
														   * Some people prefer PDO because it supports named parameter. */
														  $stmt->bind_param('si', $youtube, $id);

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
														  printf("<p>Youtube %d Row inserted.</p>\n", $stmt->affected_rows);
														}

														/* Check if POST contains Email address */
														if(isset($_POST['email']))
														{
															$email = $_POST['email'];
															echo "<p>Email address set to: ". $email ."</p>";

														  $stmt = $mysqli->prepare("UPDATE users SET email=? WHERE id=?");
														  /* BK: always check whether the prepare() succeeded */
														  if ($stmt === false) {
														    trigger_error($mysqli->error, E_USER_ERROR);
														    return;
														  }
														  /* Bind our params */
														  /* BK: variables must be bound in the same order as the params in your SQL.
														   * Some people prefer PDO because it supports named parameter. */
														  $stmt->bind_param('si', $email, $id);

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
														  printf("<p>Email %d Row inserted.</p>\n", $stmt->affected_rows);
														}

														/* Check if POST contains twitter url */
														if(isset($_POST['twitter']))
														{
															$twitter = $_POST['twitter'] ?: '';
														  	echo "<p>Twitter account set to: ". $twitter ."</p>";

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
														  printf("<p>Twitter %d Row inserted.</p>\n", $stmt2->affected_rows);
														} else echo "No Post";
													}

											} else{
													// Display an error message if password is not valid
													$password_err = "The password you entered was not valid.";
											}
									}
							}
					} else{
							echo "Oops! Something went wrong. Please try again later.";
					}
			}

			// Close statement
			mysqli_stmt_close($state);
	}

	// Close connection
	mysqli_close($mysqli);
?>
<aside>
  <!-- Sidebar / Ads -->
</aside>

<footer>
  <!-- Footer content -->
</footer>
</div>
</body>
</html>
