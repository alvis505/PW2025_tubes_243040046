<?php
//////////////////////////////////////////////////////////////////////////////////////////
//CONNECT
$conn = mysqli_connect('localhost', 'root', '', 'pw2025_243040046');

//FUNCTION QUERY
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
//////////////////////////////////////////////////////////////////////////////////////////

//FUNCTION ADD
function add($data) {
    global $conn;
    $name = htmlspecialchars($data["name"]);
    $creation = htmlspecialchars($data["creation"]);
    $from = htmlspecialchars($data["from"]);
    $date_created = htmlspecialchars($data["date_created"]);
    //htmlspecialchars for infucntion tag html or css
    
    //UPLOAD IMAGE
    $image = upload();
    if(!$image) {
        return false;
    }

    //QUERY INSERT DATA
    $query = "INSERT INTO `famous work of art` 
            (`id`, `name`, `creation`, `from`, `date_created`, `img`) 
            VALUES (NULL, '$name', '$creation', '$from', '$date_created', '$image')
            ";

    //DATA RUNNING
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
//////////////////////////////////////////////////////////////////////////////////////////

//FUNCTION UPLOAD FOR UPLOAD IMAGE
function upload() {
    $nameFile = $_FILES["image"]["name"];
    $fileSize = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    //CHECK THE IMAGE IS UPLOADED OR NOT
    if ($error === 4) {
        echo "<script>
            alert('Upload gambar terlebih dahulu!');
        </script>";
        return false;
    }

    // CHECK VALID FILE EXTENSION (JPG, JPEG, PNG)
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $nameFile);
    $imageExtension = strtolower(end($imageExtension));

    if (!in_array($imageExtension, $validImageExtension)) {
        echo "<script>
            alert('Yang diupload bukan gambar!');
        </script>";
        return false;
    }

    //  CHECK MAXIMUM FILE 2MB (2 * 1024 * 1024 bytes)
    if ($fileSize > 2 * 1024 * 1024) {
        echo "<script>
            alert('Ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    // GENERATE NEW NAME FILE SO IT'S NOT THE SAME WITH OTHER FILES
    $newNameFile = uniqid() . '.' . $imageExtension;

    // MOVE TO DESTINATION FOLDER
    move_uploaded_file($tmpName, 'img/' . $newNameFile);

    return $newNameFile; // Return new file name to save to DB

}
//////////////////////////////////////////////////////////////////////////////////////////

//FUNCTION DELETE
function delete($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM famous work of art WHERE id = $id");

    return mysqli_affected_rows($conn);
}
//////////////////////////////////////////////////////////////////////////////////////////

//FUNCTION UPDATE
function update($data) {
    global $conn;
$id = $data["id"];
$name = htmlspecialchars($data["name"]);
$creation = htmlspecialchars($data["creation"]);
$from = htmlspecialchars($data["from"]);
$date_created = htmlspecialchars($data["date_created"]);

$oldImage = htmlspecialchars(($data["oldImage"]));

if ($_FILES['image']['error'] === 4) {
    $image = $oldImage;
} else {
    $image = upload();
}

//QUERY INSERT DATA
$id = $_GET["id"];
$query = "UPDATE `famous work of art` SET 
`name` = '$name', 
`creation` = '$creation', 
`from` = '$from', 
`date_created` = '$date_created', 
`img` = '$image' 
WHERE `famous work of art`.`id` = $id
";

//DATA RUNNING
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}
//////////////////////////////////////////////////////////////////////////////////////////

//FUNCTION SEARCH
function search($keyword) {
    $query = "SELECT * FROM famous work of art
                 WHERE 
            'name' LIKE '%$keyword%' OR
            'creation' LIKE '%$keyword%' OR
            'from' LIKE '%$keyword%' OR
            'date_created' LIKE '%$keyword%'
             ";
    return query($query);
}
//////////////////////////////////////////////////////////////////////////////////////////

//FUNCTION REGISTRATION
function registration($_data) {
    global $conn;

    // Use $_data consistently
    $username = strtolower(stripslashes($_data['username']));
    $password = mysqli_real_escape_string($conn, $_data["password"]);
    $password2 = mysqli_real_escape_string($conn, $_data["password2"]);


    //Check username to make sure there are no duplicates
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah digunakan');
        </script>
        ";

        return false; //for false
    }


    //checking password
    if ($password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // var_dump($password);

    //query to database
    mysqli_query($conn, "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '$username', '$password')");

    return mysqli_affected_rows($conn);
}




?>