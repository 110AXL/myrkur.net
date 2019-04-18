<?php
// add in the config file
require(__DIR__."/config.php");
?><!DOCTYPE html>
<html>
<meta charset="UTF-8">
<title>My Login</title>
<head>
</head>
<body>
    <form id="loginForm" method="post" action="">
        <input name="username" type="text" />
        <input name="password" type="password" />
        <input name="action" type="hidden" value="login" />
        <input type="submit" value="LOGIN" />
    </form>
</body>
</html>
