<html>
   
   <head>
      <title>Delete a Record from MySQL Database</title>
   </head>
   
   <body>
      <?php
         if(isset($_POST['delete'])) {
            $dbhost = 'localhost';
            $dbuser = 'u445255185_zc4r';
            $dbpass = 'AXL110axl';
			$dbname = "u445255185_sweet";
            $conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);
            
            if(! $conn ) {
               die('Could not connect: ' . mysql_error());
            }
				
			$artist = htmlspecialchars($_GET['artist']);
            $album = htmlspecialchars($_GET['album']);
			
            
			
            $sql = "DELETE FROM albums WHERE artist=$artist AND album=$album" ;
            mysql_select_db('test_db');
            $retval = mysql_query( $sql, $conn );
            
            if(! $retval ) {
               die('Could not delete data: ' . mysql_error());
            }
            
            echo "Deleted data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               del
            <?php
         }
      ?>
      
   </body>
</html>