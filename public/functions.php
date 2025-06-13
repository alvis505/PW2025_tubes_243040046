<?php

use function PHPSTORM_META\map;

$conn = mysqli_connect("localhost", "root", "", "PW2025_243040046");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// FUNCTION ADD
function add($data) {
    global $conn;
    $name = htmlspecialchars($data["name"]);
    $date = htmlspecialchars($data["date"]);

    $image = upload();
    if (!$image) {
        return false;
    }

    $des = htmlspecialchars($data["des"]);

    $query = "INSERT INTO art (id, name, date, image, des) 
              VALUES (NULL, '$name', '$date', '$image', '$des')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// FUNCTION UPLOAD IMAGE
function upload() {
    $nameFile = $_FILES["image"]["name"];
    $fileSize = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Upload gambar terlebih dahulu!');</script>";
        return false;
    }

    $validImageExtension = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
    $imageExtension = explode('.', $nameFile);
    $imageExtension = strtolower(end($imageExtension));

    if (!in_array($imageExtension, $validImageExtension)) {
        echo "<script>alert('Yang di upload bukan gambar atau file yang diperbolehkan');</script>";
        return false;
    }

    if ($fileSize > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }

    $newNameFile = uniqid() . '.' . $imageExtension;
    move_uploaded_file($tmpName, 'img/' . $newNameFile);

    return $newNameFile;
}

// FUNCTION DELETE
function delete($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM art WHERE id = $id");
    return mysqli_affected_rows($conn);
}

// FUNCTION UPDATE
function update($data) {
    global $conn;
   
    $id = $data["id"];
    $name = htmlspecialchars($data["name"]);
    $date = htmlspecialchars($data["date"]);
    $oldImage = htmlspecialchars($data["oldImage"]);

      if ($_FILES['image']['error'] === 4) {
        $image = $oldImage;
    } else {
        $image = upload();
        if (!$image) {
            return false;
        }
    }

    $id = $_GET["id"];
    $query = "UPDATE art SET 
                name = '$name', 
                date = '$date', 
                image = '$image' 
              WHERE id = $id";

    //RUNNING DATA
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// FUNCTION SEARCH
function search($keyword) {
    $query = "SELECT * FROM art
              WHERE 
              name LIKE '%$keyword%' OR
              date LIKE '%$keyword%'";
    return query($query);
}

// FUNCTION REGISTRATION
function registration($_data) {
    global $conn;

    $username = strtolower(stripslashes($_data['username']));
    $password = mysqli_real_escape_string($conn, $_data["password"]);
    $password2 = mysqli_real_escape_string($conn, $_data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('username sudah digunakan');</script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>alert('konfirmasi password tidak sesuai');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users (id, username, password) VALUES (NULL, '$username', '$password')");
    return mysqli_affected_rows($conn);
}
?>
