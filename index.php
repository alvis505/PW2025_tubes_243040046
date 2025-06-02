<?php
//connectin first to database
$db = mysqli_connect("localhost", "root", "", "pw2024_243040046");

//query to table
$result = mysqli_query($db, "SELECT * FROM famous work of art");

//save data to array
$rows = [];  //array
while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

$art = $rows;

?>


<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art</title>
</head>

<body>
  <h1>What Is Art?</h1>

  <p>Art is a form of human expression that involves creating visual, auditory, or 
    performance-based works intended to communicate ideas, emotions, or a unique 
    perspective. It encompasses a wide range of mediums, such as painting, sculpture, 
    music, dance, theater, literature, and film, among others. Through art, individuals 
    often convey their thoughts, cultural values, or personal experiences. Art can evoke 
    emotions, provoke thought, or simply provide aesthetic enjoyment. It is a reflection 
    of society, history, and individual creativity, and it can be interpreted in many 
    different ways, depending on the viewer's perspective.</p>

  <table border="1" cellspacing="0" cellpadding="10">
    <tr>
      <th>No</th>
      <th>Name</th>
      <th>Creation</th>
      <th>From</th>
      <th>Date Created</th>
      <th>Image</th>
      <th>Aksi</th>
    </tr>

    <?php foreach($mahasiswa as $mhs) :?>
    <tr>
      <td><?= $mhs["id"]; ?></td>
      <td><?= $mhs["nama"]; ?></td>
      <td><?= $mhs["nim"]; ?></td>
      <td><?= $mhs["email"]; ?></td>
      <td><?= $mhs["jurusan"]; ?></td>
      <td>
        <img src="img/<?= $mhs["gambar"]; ?>" width="50">
      </td>
      <td>
        <a href="">ubah</a> | <a href="">hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>