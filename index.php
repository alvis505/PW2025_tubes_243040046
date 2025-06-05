<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="css/index-style.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>
<body>

<!-- NAVBAR -->
 <nav class="navbar navbar-expand-lg bg-body-tertiary" style="position: fixed; width: 100%; z-index: 1000; top:0;">
  <div class="container-fluid">
    <a class="navbar-brand" href="logout2.php">ART</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gallery.php">Galery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-5" type="search" disabled placeholder="Search" id="keyword" aria-label="Search"/>
      </form>
    </div>
  </div>
</nav>
<!-- ////////////////////////////////////////////////////////////////////////// -->
    
 <section class="hero">
    <div class="container text-center">
      <h1 class="title">What is Art?</h1>
      <p class="description">
        Art is a form of expression that transcends language, time, and culture. 
        It encompasses a diverse range of human activities, from painting and sculpture 
        to music, literature, dance, and digital creations. Art reflects emotions, 
        thoughts, and the human experience, inviting us to see the world through a different lens.
      </p>
      <p class="description">
        Whether abstract or realistic, ancient or modern, art challenges perceptions 
        and sparks imagination. It connects people, preserves history, and inspires change.
      </p>
    </div>
<br><br><br>
<!-- Footer -->
<footer class="footer">
  <div class="footer-container container">
    <div class="footer-left">
      <p>&copy; 2025 Nama Perusahaan. All rights reserved.</p>
    </div>
  </div>
</footer>
  </section>




</body>
</html>