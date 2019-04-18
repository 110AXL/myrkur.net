<?php
session_start();
// Include config file
require_once "sqlcon.php";

// Define variables and initialize with empty values
$username = $email = $password = $confirm_password  = $twitter = $twitch = $discord = $youtube = $psn = "";

$username_err = $password_err = $confirm_password_err = $email_err = $twitter_err = $twitch_err = $discord_err = $youtube_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

	 // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    /* $email_err = "This email is already taken. It will also be used for this account."; */
                    $email = trim($_POST["email"]);
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Twitter handle
    if(substr(trim($_POST["twitter"]), 0, 1) == "@"){
        $twitter_err = "Twitter handle must not start with @";
    } else{
        $twitter = trim($_POST["twitter"]);
    }

    // Twitch channel
    if(!empty(trim($_POST["twitch"]))){
        $twitch = trim($_POST["twitch"]);
    }

    // Discord username
    if(substr(trim($_POST["discord"]), -5, 1) == "#"){
        $discord_err = "Your Discord username should look something like this: username#0000";
    } else{
        $discord = trim($_POST["discord"]);
    }

    // Playstation Network username
    if(!empty(trim($_POST["psn"]))){
        $psn = trim($_POST["psn"]);
    }

    // Youtube channel
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
        $youtube_err = "Youtube link must start with http://www.youtube.com , https://www.youtube.com , http://youtube.com or https://youtube.com";
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($email_err)&& empty($twitter_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, email, twitter, twitch, discord, psn, youtube) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_username, $param_password, $param_email, $param_twitter, $param_twitch, $param_discord, $param_psn, $param_youtube);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            $param_twitch = $twitch;
            $param_twitter = $twitter;
            $param_discord = $discord;
            $param_psn = $psn;
            $param_youtube = $youtube;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "<h1>Registration complete.</h1><h2>Redirecting you in 5 seconds..</h2>";

                $sql = "SELECT id, username FROM users WHERE username = ?";

                if($stmt = mysqli_prepare($mysqli, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);

                    // Set parameters
                    $param_username = $username;

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Store result
                        mysqli_stmt_store_result($stmt);

                        // Check if username exists, if yes then verify password
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            // Bind result variables
                            mysqli_stmt_bind_result($stmt, $id, $username);
                            if(mysqli_stmt_fetch($stmt)){
                                    // start session
                                    session_start();

                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;
                                    ini_set('session.gc_maxlifetime', 3600);
                                    // Redirect user to welcome page
                                    header("location: welcome.php");
                                }
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($mysqli);
  }
}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script src='https://www.google.com/recaptcha/api.js?render=6Le4LHsUAAAAAKwatXhyWMwqgwcoIG88JbmAXLas'></script>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill out this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Pick a Username for myrkur.net</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
				    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email address</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($twitter_err)) ? 'has-error' : ''; ?>">
                <label>Twitter username (Without @)</label>
                <input type="text" name="twitter" placeholder="enter your twitter username here" class="form-control" value="<?php echo $twitter; ?>">
                <span class="help-block"><?php echo $twitter_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($twitch_err)) ? 'has-error' : ''; ?>">
                <label>Twitch username</label>
                <input type="text" name="twitch" placeholder="enter your twitch username here" class="form-control" value="<?php echo $twitch; ?>">
                <span class="help-block"><?php echo $twitch_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($discord_err)) ? 'has-error' : ''; ?>">
                <label>Discord username</label>
                <input type="text" name="discord" placeholder="enter your discord username here" class="form-control" value="<?php echo $discord; ?>">
                <span class="help-block"><?php echo $discord_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($psn_err)) ? 'has-error' : ''; ?>">
                <label>Playstation Network username</label>
                <input type="text" name="psn" placeholder="enter your playstation network username here" class="form-control" value="<?php echo $psn; ?>">
                <span class="help-block"><?php echo $psn_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($youtube_err)) ? 'has-error' : ''; ?>">
                <label>Youtube channel link</label>
                <input type="text" name="youtube" placeholder="enter your youtube channel link here (with http//)" class="form-control" value="<?php echo $youtube; ?>">
                <span class="help-block"><?php echo $youtube_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
			 <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
				  <script>
				  grecaptcha.ready(function() {
					  grecaptcha.execute('reCAPTCHA_site_key', {action: 'homepage'}).then(function(token) {
						 ...
					  });
				  });
				  </script>

            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
