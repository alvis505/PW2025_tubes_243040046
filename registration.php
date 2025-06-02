<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (registration($_POST) > 0) {
        echo "<script>
        alert('user berhasil di buat!');
        ";
    } else {
        echo mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <link rel="stylesheet" href="css/regist-style.css">
</head>
<body>
    <h1>Registration!</h1>

    <!-- Ombak animasi di bawah -->
<div class="wave-container">
  <div class="wave"></div>
</div>


<div class="reg">
    <table>
        <div class="inputreg">
        <form action="" method="post">
            <tr>
                <td><label for="username">username :</label></td>
                <td><input type="text" name="username" id="username" require></td>
            </tr>

            <tr>
                <td><label for="password">password :</label></td>
                <td><input type="password" name="password" id="password" require></td>
            </tr>

            <tr>
                <td><label for="password2">confirm password :</label></td>
                <td><input type="password" name="password2" id="password2" require></td>
            </tr>

            <tr>
                <td><button type="submit" name="register">Register</button></td>
            </tr>
        </form>
    </div>
    </table>
</div>

</body>
</html>