<?php
// add in the config file
require(__DIR__."/medlimir/config.php");
?><!DOCTYPE html>
<html>
<body>
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '316701355598726',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.2'
    });
    FB.login(function(response) {
      if (response.authResponse) {
       console.log('Welcome!  Fetching your information.... ');
       FB.api('/me', function(response) {
         console.log('Good to see you, ' + response.name + '.');
       });
      } else {
       console.log('User cancelled login or did not fully authorize.');
      }
  });
  };
</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
asdf
</body>
</html>
