 <!-- Example -->
<!DOCTYPE html>



<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="http://myrkur.net/res/default.css">
<?php include('./res/facebookPixelCode.php'); ?>
</head>
<body bgcolor="black">
 <?php
include './res/ipgrabber.php';
include './hidden/sqlcon.php';
include './res/header.php';


$sql = "SELECT movies.name, movies.year, movies.link, movies.img, users.username FROM movies LEFT JOIN users ON movies.user_id = users.id ORDER BY movies.id DESC";

$result = $mysqli->query($sql);


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
$mysqli->close();
?>
</body>
</html>
