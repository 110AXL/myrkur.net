<?php
$username = “MySQL database username”;
$password = “MySQL database password”;
$hostname = “MySQL database hostname”;
$database = “Name of your MySQL database”;
$username =escapeshellcmd($username);
$password =escapeshellcmd($password);
$hostname =escapeshellcmd($hostname);
$database =escapeshellcmd($database);
$backupFile=’/home/www/example.com/backuprestricted/’.date(“Y-m-d-H-i-s”).$database.’.sql’;
$command = “mysqldump -u$username -p$password -h$hostname $database > $backupFile”;
system($command, $result);
echo $result;
?>
