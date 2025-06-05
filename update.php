<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';


//ambil id di url
$id = $_GET["id"];
// var_dump($id);

//query mahasiswa berdasarkan id
$mhs = query("SELECT * FROM art WHERE id = $id")[0];  //0 untuk array numerik terluar
// var_dump($mhs);


if (isset($_POST["submit"])) {

    if ( update($_POST) > 0) {
        echo "<script>
        alert('data berhasil di ubah')
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "<script>
        alert('data berhasil di ubah')
        </script>
        ";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="css/update-style.css">
</head>
<body>
    <h1>Update Data</h1>

    <table>
        <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden"  name="id" id="id" value="<?= $mhs["id"]?>">
        <input type="hidden"  name="oldImage" id="oldImage" value="<?= $mhs["image"]?>">
           <tr>
            <td> <label for="name">name</label></td>
            <td> <input type="text" name="name" id="name" required value="<?= $mhs["name"]?>"></td>
        </tr>

        <tr>
            <td><label for="date">date</label></td>
            <td><input type="text" name="date" id="date" value="<?= $mhs["date"]?>"></td>
        </tr>

        <tr>
            <td> <label for="image">image</label></td>
            <img src="img/<?= $mhs["image"]?>" alt="">
            <td> <input type="file" name="image" id="image"></td>
        </tr>

        <tr>
            <td>
                <button type="submit" name="submit">update data</button>
            </td>
        </tr>
        </form>
    </table>
    
</body>
</html>