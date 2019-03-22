 <!-- Example -->
<!DOCTYPE html>


			
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="../default.css">
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
<body bgcolor="black">
 <?php
include '../ipgrabber.php';
include '../sqlcon.php';
include '../header.php';


$sql = "SELECT movies.name, movies.year, movies.link, movies.img, users.username FROM movies LEFT JOIN users ON movies.user_id = users.id ORDER BY movies.id DESC";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$resized_link = substr_replace($row["img"],"r_",8,0);
		$removed_spaces = str_replace(" ","%20",$resized_link);
        if($row["year"] && $row["link"] == NULL)
			echo "<a target=_blank title='" . $row["name"]. " [" . $row["username"] . "]' href=" . "><img width=200 height=200 src=/movies/" . $removed_spaces . " /></a>";
		else if($row["year"] == NULL)
			echo "<a target=_blank title='" . $row["name"]. " [" . $row["username"] . "]' href=" . $row["link"]. "><img width=200 height=200 src=/movies/" . $removed_spaces . " /></a>";
		else
			echo "<a target=_blank title='" . $row["name"]. " - " . $row["year"]. " [" . $row["username"] . "]' href='" . $row["link"]."'><img width=200 height=200 src=/movies/" . $removed_spaces . " /></a>";
    }
}
$conn->close();
?> 
</body>
</html> 