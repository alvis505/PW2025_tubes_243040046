<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php'; // pastikan ini file yang berisi fungsi tambah(), upload(), dll

// Proses submit form
if (isset($_POST['submit'])) {
    if (update($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Data gagal ditambahkan');
            document.location.href = 'tambah.php';
        </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Data Mahasiswa</title>
</head>
<body>

<h1>UPDATE DATA</h1>

<form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="name">name :</label>
            <input type="text" name="name" id="name" required />
        </li>
        <li>
            <label for="creation">creation :</label>
            <input type="text" name="creation" id="creation" required />
        </li>
        <li>
            <label for="from">from :</label>
            <input type="text" name="from" id="from" required />
        </li>
        <li>
            <label for="date_created">date created :</label>
            <input type="text" name="date_created" id="date_created" required />
        </li>
        <li>
            <label for="image">image :</label>
            <input type="file" name="image" id="image" required />
        </li>
        <li>
            <button type="submit" name="submit">Update Data!</button>
        </li>
    </ul>
</form>

</body>
</html>
