echo "
  <!DOCTYPE html>
  <html lang='en'>
  <head>
    <meta charset='UTF-8'>
    <title>Login</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css'>
    <style type='text/css'>
      body{ font: 14px sans-serif; }
      .wrapper{ width: 350px; padding: 20px; }
    </style>
    <!-- Facebook Pixel Code -->
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '260449551282360');
    fbq('track', 'PageView');
  </script>
  <noscript><img height='1' width='1' style='display:none'
    src='https://www.facebook.com/tr?id=260449551282360&ev=PageView&noscript=1'
  /></noscript>
  <!-- End Facebook Pixel Code -->
  </head>
  <body bgcolor='black'>
    <div class='wrapper'>
      <h2>Login</h2>
      <p>Please fill in your credentials to login.</p>
      <form action='"; echo htmlspecialchars($_SERVER['PHP_SELF']); echo "' method='post'>
        <div class='form-group"; echo (!empty($username_err)) ? 'has-error' : ''; echo "'>
          <label>Username</label>
          <input type='text' name='username' class='form-control' value='"; echo $username; echo "'>
          <span class='help-block'>"; echo $username_err; echo "</span>
        </div>
        <div class='form-group "; echo (!empty($password_err)) ? 'has-error' : ''; echo "'>
          <label>Password</label>
          <input type='password' name='password' class='form-control'>
          <span class='help-block'>"; echo $password_err; echo "</span>
        </div>
        <div class='form-group'>
          <input type='submit' class='btn btn-primary' value='Login'>
        </div>
        <p>Don't have an account? <a href='register.php'>Sign up now</a>.</p>
      </form>
    </div>";
