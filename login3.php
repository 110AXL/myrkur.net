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
    FB.ui({
      method: 'share_open_graph',
      action_type: 'og.likes',
      action_properties: JSON.stringify({
        object:'https://developers.facebook.com/docs/javascript/examples',
      })
    }, function(response){
      // Debug response (optional)
      console.log(response);
    });
  };
</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
asdf
</body>
</html>
