<?php
// Initialize the session
require(__DIR__."/sqlcon.php");
// get sql config
 // Before using $_POST['value']
if (isset($_GET['nafn']))
{
	$nafn = htmlspecialchars($_GET["nafn"]);
}

if(isset($nafn) === FALSE){
// Check if the user is already logged in, if yes then redirect him to welcome page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: welcome.php");
		exit;
	}
}
    else if($nafn != NULL){
		/* ---- START VARIABLE ---- */

		$sql = "SELECT * FROM users WHERE username='" . $nafn . "'";
		$result = mysqli_query($mysqli, $sql);

		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				$result1 = $row['id'];
				echo "id: " . $row['id']. " - Name: " . $row['username'] . "<br>";
			}
		} else {
			echo "0 results";
		}



		$sql2 = "SELECT artist, album, link1, img FROM albums WHERE user_id='" . $result1 . "' ORDER BY id DESC";
		$result2 = $mysqli->query($sql2);
		$result3 = $mysqli->query($sql2);


		if(isset($result2) == TRUE){
			if ($result2->num_rows > 0) {
				echo "<html lang='en'>
					<head>
						<meta charset='UTF-8'>
						<title>Login</title>
						<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css'>";
						include(__DIR__.'/res/facebookPixelCode.php');

			echo "<link rel='shortcut icon' type='image/png' href=".__DIR__."'/res/favicon-16x16.png'/>
					</head>";
					// output data of each row
				while($row = $result2->fetch_assoc()) {

					$resized_link = $row["img"];
					$removed_spaces = str_replace(" ","%20",$resized_link);

					if(!$row["album"] == NULL)
						echo "<a target=_blank title='" . $row["artist"]. " - " . $row["album"]. "' href='" . $row["link1"]. "'><img width=200 height=200 src=/uploads/" . $removed_spaces . " /></a>";
				}
		echo "</body>";
		}
	$mysqli->close();
		/* ---- END VARIABLE ---- */
	}
}


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

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
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
														// set cookie on root
														session_set_cookie_params(time() + (864000 * 30),"/", ".myrkur.net", true);
														$cookie_name = "user";
														$cookie_value = $username;
														setcookie($cookie_name, $cookie_value, time() + (864000 * 30), "/"); // 864000 = 10 days
														ini_set('session.cookie_domain', '.myrkur.net' );
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;


                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($mysqli);
}

if(isset($_SESSION["loggedin"]) === false){
		Include('login.php');
	exit;
	}

?>
</body>
</html>
