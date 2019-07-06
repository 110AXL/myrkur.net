<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="HolyGrail.css">
  <title>My First HTML</title>
  <meta charset="UTF-8">
</head>
<body>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{api-version}'
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

<div class="grid">
  <header>
    Linkur1 Linkur2
  </header> </div>
<button class="collapsible">Open Collapsible</button>
<div class="content">fff><div class="grid"><aside class="sidebar-left">
    Punktar
  </aside>

  <article>
    Ræða
  </article>

  <aside class="sidebar-right">
    Viðbrögð
  </aside>
</div>

  <footer>
    Skrá styrk 1000 | 1500 | 2000
  </footer>
</div></div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>


</body>
</html>
