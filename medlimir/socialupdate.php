<?php
session_start();
include 'res/logo.html';
// Define variables and initialize with empty values
$twitter = $param_twitter = $twitch = $param_twitch = "";
$id = $_SESSION['id'];
include "sqlcon.php";

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

?>
