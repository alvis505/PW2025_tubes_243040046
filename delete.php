<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
$id = $_GET["id"];

if( delete($id) > 0) {
    echo "<script>
alert('data berhasil di hapus');
document.location.href = 'index.php';
</script>";
} else {
    echo "data gagal di hapus";
}
?>