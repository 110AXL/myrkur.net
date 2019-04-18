<?php
require_once __DIR__ . '/php-graph-sdk/src/Facebook/autoload.php';
// add in the config file
require(__DIR__."/medlimir/config.php");
?><!DOCTYPE html>
<html>
<meta charset="UTF-8">
<title>My Login</title>
<head>
  <!-- HTTPS required. HTTP will give a 403 forbidden response -->
  <script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
<script>
  // initialize Account Kit with CSRF protection
  AccountKit_OnInteractive = function(){
    AccountKit.init(
      {
        appId:"{{FACEBOOK_APP_ID}}",
        state:"{{csrf}}",
        version:"{{ACCOUNT_KIT_API_VERSION}}",
        fbAppEventsEnabled:true,
        redirect:"{{REDIRECT_URL}}"
      }
    );
  };

  // login callback
  function loginCallback(response) {
    if (response.status === "PARTIALLY_AUTHENTICATED") {
      var code = response.code;
      var csrf = response.state;
      // Send code to server to exchange for access token
    }
    else if (response.status === "NOT_AUTHENTICATED") {
      // handle authentication failure
    }
    else if (response.status === "BAD_PARAMS") {
      // handle bad parameters
    }
  }

  // phone form submission handler
  function smsLogin() {
    var countryCode = document.getElementById("country_code").value;
    var phoneNumber = document.getElementById("phone_number").value;
    AccountKit.login(
      'PHONE',
      {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
      loginCallback
    );
  }


  // email form submission handler
  function emailLogin() {
    var emailAddress = document.getElementById("email").value;
    AccountKit.login(
      'EMAIL',
      {emailAddress: emailAddress},
      loginCallback
    );
  }
</script>
<script>
  function loginCallback(response) {
    if (response.status === "PARTIALLY_AUTHENTICATED") {
      document.getElementById("code").value = response.code;
      document.getElementById("csrf").value = response.state;
      document.getElementById("login_success").submit();
    }
  }
</script>
</head>
<body>
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '316701355598726',
      xfbml      : true,
      version    : 'v3.2'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
    <form id="login_success" method="post" action="/login_success.php">
        <input name="username" type="text" />
        <input name="password" type="password" />
        <input name="action" type="hidden" value="login" />
        <input type="submit" value="LOGIN" />

        <input id="csrf" type="hidden" name="csrf" />
        <input id="code" type="hidden" name="code" />

        <input value="+354" id="country_code" />
        <input placeholder="phone number" id="phone_number"/>
        <button onclick="smsLogin();">Login via SMS</button>
        <div>OR</div>
        <input placeholder="email" id="email"/>
        <button onclick="emailLogin();">Login via Email</button>
    </form>
    <div
      class="fb-like"
      data-share="true"
      data-width="450"
      data-show-faces="true">
    </div>
</body>
</html>
