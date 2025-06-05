<?php
require '../functions.php';
$keyword = $_GET["keyword"];

$query = ("SELECT * FROM art
              WHERE 
              name LIKE '%$keyword%' OR
              date LIKE '%$keyword%'
             ");
$art = query($query);

?>

<table border="1" cellpadding="10" cellspacing="0" >

        <tr>
            <td>no</td>
            <td>action</td>
            <td>image</td>
            <td>name</td>
            <td>date</td>
        </tr>

        <?php $i = 1;?>
        <?php foreach($art as $row) : ?>
            <tr>
                <td> <?= $i++ ; ?> </td>
                <td> 
                    <a href="update.php?id=<?= $row["id"];?>"> Change </a> |
                    <a href="delete.php?id=<?= $row["id"];?>" onclick="return confirm('Are you sure want delete this data?');"> Delete   </a>
                </td>
                <td> <img src="img/<?= $row["image"];?>" alt=""> </td>
                <td> <?= $row["name"]; ?> </td>
                <td> <?= $row["date"]; ?> </td>
            </tr>
        <?php endforeach ; ?>

        <script src="js/script.js"></script>
    </table>