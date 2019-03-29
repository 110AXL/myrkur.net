<?php
//IP Grabber
require_once './hidden/sqlcon.php';





//Variables
$ref = "";
$protocol = $_SERVER['SERVER_PROTOCOL'];
$ip = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['REMOTE_PORT'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$date = date('d/m/Y H:i:s', time());
$site = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



if(isset($_SERVER['HTTP_REFERER'])) {
	$ref = $_SERVER['HTTP_REFERER'];
};


// prepare and bind
$stmt = $mysqli->prepare("INSERT INTO log (ip, hostname, port, user_agent, protocol, referer, site) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssissss", $ip, $hostname, $port, $agent, $protocol, $ref, $site);

$stmt->execute();
$stmt->close();
$mysqli->close();


/* --- Old log file ---
$blocked = array("compute.amazonaws.com");
$allowed = array("googlebot.com", "researchscan5.comsys.rwth-aachen.de", "msnbot", "spider.yandex.com");

$log = "log/log.txt";
$blocked_log = "log/blocked.txt";
$allowed_log = "log/allowed.txt";


function prepend($string, $orig_filename) {
  $context = stream_context_create();
  $orig_file = fopen($orig_filename, 'r', 1, $context);

  $temp_filename = tempnam(sys_get_temp_dir(), 'php_prepend_');
  file_put_contents($temp_filename, $string);
  file_put_contents($temp_filename, $orig_file, FILE_APPEND);

  fclose($orig_file);
  unlink($orig_filename);
  rename($temp_filename, $orig_filename);
  chmod($orig_filename,0644);
}

function contains($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}

if(isset($_SERVER['HTTP_REFERER'])) {
	$file_data = $date ."\n IP Address: " . $ip ."\n Hostname: " . $hostname . "\n Port number: " . $port . "\n User agent: " . $agent . "\n HTTP referer: " . $ref . "\n\n";
}
else {
	$file_data = $date ."\n IP Address: " . $ip ."\n Hostname: " . $hostname . "\n Port number: " . $port . "\n User agent: " . $agent . "\n\n";
};

if(contains($hostname, $blocked)) {
	echo "You are on the blocked list.<br/>Contact ekkert@myrkur.net to get removed from the blocked list.</br>";
	prepend($file_data, $blocked_log);
	return false; }
else if (contains($hostname, $allowed)) {
	echo "You are on the allowed bot list.<br/>Contact ekkert@myrkur.net if you don't want to be considered as an allowed bot.</br>";
	prepend($file_data, $allowed_log);
}
else
	prepend($file_data, $log);
*/
?>
