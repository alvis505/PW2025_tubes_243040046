<?php


session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php'; // pastikan ini file yang berisi fungsi tambah(), upload(), dll

// Proses submit form
if (isset($_POST['submit'])) {
    if (add($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'admin.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Data gagal ditambahkan');
            document.location.href = 'update.php';
        </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>ADD DATA</title>
    <link rel="stylesheet" href="css/insert-style.css">
</head>
<body>
<div class="container">

<h1>Add Data</h1> 

<table>
<form action="" method="post" enctype="multipart/form-data" class="contact-form">
    <tr>
        <td><label for="name">name :</label></td>
        <td><input type="text" name="name" id="name" required autocomplete="off" /></td>
    </tr>
    <tr>
            <td><label for="date">date :</label></td>
            <td><input type="text" name="date" id="date" required /></td>
    </tr>
    <tr>
            <td><label for="image">image :</label></td>
            <td><input type="file" name="image" id="image" /></td>
    </tr>
    <tr>
            <td><button type="submit" name="submit">Add Data</button></td>
            <td><a href="admin.php" class="back-link"> back </a></td>
    </tr>
</form>
</table>
</div>
</body>
</html>
