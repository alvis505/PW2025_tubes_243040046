<?php
require 'functions.php';

$arts = query("SELECT * FROM art");


//page
//konfigurasi
$jumlahDataPerHalaman = 9;
$jumlahData = count(query("SELECT * FROM art"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
//ceil membulatkan bilangan pecahan ke atas lawan dari floor
$halamanAktif = (isset($_GET['page']) ) ? $_GET['page'] : 1;   
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

//data yg akan di ambil
$arts = query("SELECT * FROM art LIMIT $awalData, $jumlahDataPerHalaman");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Art Gallery</title>
  <link rel="stylesheet" href="css/gallery-style.css" />
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
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<!-- ////////////////////////////////////////////////////////////////////////// -->

<br><br><br>
  <header>
    <h1>Art Gallery</h1>
  </header>

   <!-- navigasi -->
<div class="pagination">
    <?php if($halamanAktif > 1) :?>
    <a href="?page=<?= $halamanAktif - 1 ?>"> <i class="bi bi-chevron-double-left"></i> </a>
    <?php endif ; ?>

    <?php for($i = 1; $i <= $jumlahHalaman; $i++) :?>
        <?php if($i == $halamanAktif) : ?>
            <a href="gallery.php?page=<?= $i ?>" style="color: purple;" > <?= $i ?> </a>
        <?php else : ?>
            <a href="gallery.php?page=<?= $i ?>"> <?= $i ?> </a>
        <?php endif ; ?>
    <?php endfor ; ?>

    <?php if($halamanAktif < $jumlahHalaman) : ?>
    <a href="?page=<?= $halamanAktif + 1 ?>"><i class="bi bi-chevron-double-right"></i></a> 
    <?php endif ; ?>
</div><br>


  <section class="gallery">
    <?php foreach($arts as $art) : ?>
    <div class="gallery-item">
      <img src="img/<?= $art["image"]; ?>" alt="Art 1" />
      <p><?= $art['name']; ?></p>
      <p><?= $art['date']; ?></p>
      
    </div>
    <?php endforeach; ?>
  </section>
</body>
</html>
