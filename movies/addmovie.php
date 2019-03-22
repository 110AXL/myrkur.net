<?php 
session_start();
if(!isset($_SESSION['username'])){
   header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script src='https://www.google.com/recaptcha/api.js?render=6Le4LHsUAAAAAKwatXhyWMwqgwcoIG88JbmAXLas'></script>
    <meta charset="UTF-8">
    <title>Add a movie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
	<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '260449551282360');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=260449551282360&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>
    <div class="wrapper">
        <h2>Add a movie</h2>
        <p>Please fill this form to add a movie.</p>
		<div class="form-group" >
		<form action="upload.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">


		</div>
		

	<div class="form-group"  >			
		<label id="first"> Movie:</label><br/>
		<input type="text" name="movie" id="movie"><br/>
	</div>
	<div class="form-group" >
		<label id="first">Year:</label><br/>
		<input type="text" name="year" id="year"><br/>
	</div>
	<div class="form-group" >
		<label id="first">Link:</label><br/>
		<input type="text" name="link" id="link"><br/>
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
</body>
</html>