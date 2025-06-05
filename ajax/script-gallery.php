<?php
require '../functions.php';
$keyword = $_GET["keyword"];

$query = ("SELECT * FROM art
              WHERE 
              name LIKE '%$keyword%' OR
              date LIKE '%$keyword%'
             ");
$arts = query($query);

?>

    <?php foreach($arts as $art) : ?>
    <div class="gallery-item">
      <img src="img/<?= $art["image"]; ?>" alt="Art 1" />
      <p><?= $art['name']; ?></p>
      <p><?= $art['date']; ?></p>
      
    </div>
    <?php endforeach; ?>
