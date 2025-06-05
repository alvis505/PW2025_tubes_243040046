<?php 
//connect admin to function (agar php connect ke database)
require 'functions.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


//pagination
//konfigurasi
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM art"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
//ceil membulatkan bilangan pecahan ke atas lawan dari floor
$halamanAktif = (isset($_GET['page']) ) ? $_GET['page'] : 1;   
//fungsi sama seperti if else di atas
//logic
//page 1 = data 0,1
//page 2 = data 2,3
//page 3 = data 4,5 sehingga
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

//data yg akan di ambil
$arts = query("SELECT * FROM art LIMIT $awalData, $jumlahDataPerHalaman");

//tombol search jika di tekan
if (isset($_POST["search"])) {
    $arts = search($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Databases</title>

    <!-- library -->
    <link rel="stylesheet" href="css/admin-style.css" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>
<body>

<a href="logout.php">logout</a>

    <h1>ART</h1>

    <a href="insert.php" class="text-warning bg-white"><i class="bi bi-database-add text-warning"></i></a>
    <br><br>

    <!-- SEARCH -//////////////////////////////////////////////////////////////////-->
    <form action="" method="post">
        <input type="text" name="keyword" autofocus 
        placeholder="search" autocomplete="off" id="keyword">
        <button type="submit" name="search" id="search"> search </button>
    </form>
    <!-- ///////////////////////////////////////////////////////////////////////////// -->
    <br><br>

    <!-- navigasi -->
<div class="pagination">
    <?php if($halamanAktif > 1) :?>
    <a href="?page=<?= $halamanAktif - 1 ?>"> <i class="bi bi-chevron-double-left"></i> </a>
    <?php endif ; ?>

    <?php for($i = 1; $i <= $jumlahHalaman; $i++) :?>
        <?php if($i == $halamanAktif) : ?>
            <a href="admin.php?page=<?= $i ?>" style="color: red;" > <?= $i ?> </a>
        <?php else : ?>
            <a href="admin.php?page=<?= $i ?>"> <?= $i ?> </a>
        <?php endif ; ?>
    <?php endfor ; ?>

    <?php if($halamanAktif < $jumlahHalaman) : ?>
    <a href="?page=<?= $halamanAktif + 1 ?>"><i class="bi bi-chevron-double-right"></i></a> 
    <?php endif ; ?>
</div>

     <br>
     <div class="container" id="container">
     <table border="1" cellpadding="10" cellspacing="0" >

        <tr>
            <td>no</td>
            <td>action</td>
            <td>image</td>
            <td>name</td>
            <td>date</td>
        </tr>

        <?php $i = 1;?>
        <?php foreach($arts as $art) : ?>
            <tr>
                <td> <?= $i++ ; ?> </td>
                <td> 
                    <a href="update.php?id=<?= $art["id"];?>"> <i class="bi bi-pencil-square"></i> </a> |
                    <a href="delete.php?id=<?= $art["id"];?>" onclick="return confirm('Are you sure want delete this data?');"> <i class="bi bi-trash"></i>  </a>
                </td>
                <td> <img src="img/<?= $art["image"];?>" alt=""> </td>
                <td> <?= $art["name"]; ?> </td>
                <td> <?= $art["date"]; ?> </td>
            </tr>
        <?php endforeach ; ?>
    </table>
</div>

<script src="js/script.js"></script>
</body>
</html>