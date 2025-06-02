<?php
require 'functions.php';
session_start();

//check cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id ");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
if($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;

}

}

//jika sudah login maka tidak perlu untuk ke halaman login
if(isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}



if(isset($_POST["login"])) {
    global $conn;

    // Escape username to avoid SQL injection
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // Check if username exists in database
    if(mysqli_num_rows($result) === 1) {

        // Fetch associative array
        $row = mysqli_fetch_assoc($result);

        // Check password hash
        if (password_verify($password, $row['password'])) {

            //session
            $_SESSION["login"] = true;

            //check remember
            if(isset($_POST['remember'])) {
                //buat cookie
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']));
                //id dan key perlu di ganti namanya agar lebih safety
                // username perlu di hash/acak agar lebih safety
            }
            
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login-style.css">
</head>
<body>


    <h1>LOGIN</h1>

    <?php if (isset($error)) : ?>
<p> username atau password salah</p>
    <?php endif ; ?>

    <div class="form-wrapper">
  <form action="" method="post">
    <table>
      <tr>
        <td><label for="username">username :</label></td>
        <td><input type="text" name="username" id="username"></td>
      </tr>
      <tr>
        <td><label for="password">password :</label></td>
        <td><input type="password" name="password" id="password"></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember">remember me</label>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <button type="submit" name="login">Login</button>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="register-link">
          <a href="registration.php">Don't have an account? Click here</a>
        </td>
      </tr>
    </table>
  </form>
</div>

</body>
</html>