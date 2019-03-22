<?php 
session_start();
if(!isset($_SESSION['username'])){
   header("Location:index.php");
}
include '../ipgrabber.php';

$year = date("Y"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script src='https://www.google.com/recaptcha/api.js?render=6Le4LHsUAAAAAKwatXhyWMwqgwcoIG88JbmAXLas'></script>
    <meta charset="UTF-8">
    <title>Add an album</title>
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
        <h2>Add an album</h2>
        <p>Please fill this form to add an album.</p>
		<div class="form-group" >
		<form action="upload.php" method="post" enctype="multipart/form-data">
			Select an image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload"><br/>
			<input type="text" name="img_url" placeholder="Or enter image URL">
 


		</div>
		
		
	<div class="form-group"  >			
		<label id="first"> Artist's name:</label><br/>
		<input type="text" name="artist" id="artist"><br/>
	</div>
	<div class="form-group" >
		<label id="first">Album name:</label><br/>
		<input type="text" name="album" id="album"><br/>
	</div>
	<div class="form-group" >
		<label id="first">Year released:</label><br/>
		<input type="number" name="year" id="year" min="1860" value="<?php echo $year; ?>" max="<?php echo $year; ?>"><br/>
	</div>
	<p><label>Genre</label>
             <select name="genre" id="genre">
               <option id="genre" value = "idk" selected>I don't know dude, I just
I just drink blood dude</option>
               <option id="genre" name="genre" value = "rock">Rock</option>
               <option id="genre" name="genre" value = "pop">Pop</option>
               <option id="genre" name="genre" value = "metal">Metal</option>
			 </select></p>
	<div class="form-group" >
		<label id="first">Link to the music:</label><br/>
		<input type="text" name="link1" id="link1"><br/>
	</div>
	<div class="form-group" >
		<label id="first">Link 2: (Optional)</label><br/>
		<input type="text" name="link2" id="link2"><br/>
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