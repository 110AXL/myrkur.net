<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="util-functions.js"></script>
<script type="text/javascript" src="clear-default-text.js"></script> 
<link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Myrkur.net</title>
</head>

<body>
<div id="head">
	<div id="bar">
    	<div id="logo">
		<a href="http://www.myrkur.net"><img src="img/myrkur-logo.jpg" /></a>
		</div>
	</div>
</div>
<div id="menu">
	<div class="link"><a href="/music/">Music</a></div>
	<div class="link"><a>Games</a></div>
	<div class="link"><a>Sports</a></div>
	<div class="link"><a>Forum</a></div>
	<div class="link"><a>Info</a></div>
</div>
<div id="box">
	<div id="content">
		<div id="leftadd">
			<form action="AddAlbumScript.php" method="post" enctype="multipart/form-data">
			<h2>Album</h2><br  />
			<table border="0">
			<tr><td>Artist:</td> <td><input class="submissionfield" type="text" name="Artist" /></td></tr>
			<td>Album:</td> <td><input class="submissionfield" type="text" name="Name" /></td></tr> 
			<td>Label:</td><td><input class="submissionfield" type="text" name="Label" /></td></tr>
			<td>Genre:</td><td><input class="submissionfield" type="text" name="Genre" /></td></tr>
			<td>Release date:</td><td><input class="cleardefault" type="text" name="Release" value="dd.mm.yy" /></td></tr></table>  
			<h2>Links</h2><br />
			<table border="0">
			<td>Spotify:</td><td><input class="submissionfield" type="text" name="Link_Spotify" /></td></tr>
			<td>YouTube:</td><td><input class="submissionfield" type="text" name="Link_Youtube" /></td></tr>
			<td>Soundcloud:</td><td><input class="submissionfield" type="text" name="Link_Soundcloud" /></td></tr>
			<td>Other:</td><td><input class="submissionfield" type="text" name="Link_Other" /></td></tr></table> 
			<h2>Image</h2><br />
			<table border="0">
			<td><label for="file">Image:</label></td></tr>
			<td><input type="file" name="file" id="file"></td></tr></table> 
			<h2>Input</h2><br />
			<table border="0">
			<td>Password:</td><td><input class="submissionfield" type="password" name="Password"/></td></tr>
			<td>The Button:</td><td><input type="submit" value="Submit"> </td></tr></table>            
		</div>
		<div id="rightadd">
			<h2>Critique</h2><br />
			<textarea class="crit" name="critique" id="term" cols="40" rows="4"></textarea></form>
			<table><td>Rating:</td><td><input id="rating" class="cleardefault" type="number" name="Rating" value="#.#" /></td></tr></table>
		</div>
	</div>
</div>
</body>
</html>
