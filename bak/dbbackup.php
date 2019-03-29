<?php
$username = “u445255185_zc4r”;
$password = “Dim&mur%Dalur”;
$hostname = “localhost”;
$database = “u445255185_sweet”;
$username =escapeshellcmd($username);
$password =escapeshellcmd($password);
$hostname =escapeshellcmd($hostname);
$database =escapeshellcmd($database);
$backupFile=’/home/u445255185/domains/myrkur.net/public_html/bak/’.date(“Y-m-d-H-i-s”).$database.’.sql’;
$command = “mysqldump -u".$username."-p".$password."-h".$hostname $database > $backupFile”;
system($command, $result);
echo $result;
?>
