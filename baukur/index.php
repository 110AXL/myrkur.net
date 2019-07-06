<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="HolyGrail.css">
  <title>My First HTML</title>
  <meta charset="UTF-8">
</head>
<body>

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
</div></div>

  <footer>
    Skrá styrk 1000 | 1500 | 2000
  </footer>
</div>

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
