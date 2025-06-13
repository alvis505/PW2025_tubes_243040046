<?php
require 'functions.php';

// Ambil ID dari URL dan pastikan aman
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Ambil data berdasarkan ID
$arts = query("SELECT * FROM art WHERE id = $id");

// Jika tidak ada data, hentikan
if (!$arts) {
    die('Data tidak ditemukan.');
}

$art = $arts[0]; // karena query mengembalikan array

// Sertakan autoload mPDF
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

// Convert gambar ke base64 (agar muncul di PDF)
$imagePath = __DIR__ . '/img/' . $art['image'];
$imgBase64 = '';
if (file_exists($imagePath)) {
    $imgData = base64_encode(file_get_contents($imagePath));
    $imgBase64 = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imgData;
}

$html = '
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Cetak Karya Seni</title>
  <style>
    body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
    img { max-width: 400px; height: auto; margin-top: 20px; }
    h1 { font-size: 24px; margin-bottom: 10px; }
    p { font-size: 16px; }
  </style>
</head>
<body>
  <h1>' . htmlspecialchars($art["name"]) . '</h1>
  <p>Tanggal: ' . htmlspecialchars($art["date"]) . '</p>
  <img src="' . $imgBase64 . '" alt="Art Image" />
  <p>Deskripsi : <br>' . htmlspecialchars($art["des"]) . '</p>

</body>
</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output();
