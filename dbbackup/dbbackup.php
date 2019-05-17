<?php
$DATABASE="u445255185_sweet";
$DBUSER="u445255185_zc4r";
$DBPASSWD="Dim&mur%Dalur";
$PATH="/home/u445255185/domains/myrkur.net/public_html/bak/";
$FILE_NAME="myrkur.net-backup-" . date("Y-m-d") . ".sql.gz";
exec('/usr/bin/mysqldump -u '.$DBUSER.' -p'.$DBPASSWD.' '.$DATABASE.' | gzip --best > '.$PATH.$FILE_NAME);
echo "Database(".$DATABASE.") backup completed. File name: ".$FILE_NAME;
?>
