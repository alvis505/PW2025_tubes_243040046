<?php
require 'functions.php';

session_start();

if (!isset($_SESSION["login"])) {
     echo "<script>
        if (confirm('Anda belum login. Apakah Anda ingin login sekarang?')) {
            window.location.href = 'login.php';
        } else {
            window.history.back();
        }
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Test Navbar</title>
  <link rel="stylesheet" href="css/contact-style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

< <nav class="navbar navbar-expand-lg bg-body-tertiary" style="position: fixed; width: 100%; z-index: 1000; top:0;">
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
<!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->

<br><br>

  <main class="form-wrapper">
    <h1>Contact</h1>
    <form action="#" method="POST" class="contact-form">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message</label>
      <textarea id="message" name="message" rows="6" required></textarea>

      <button type="submit" class="submit">Send</button>
    </form>
  </main>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
