<?php
    include_once("koneksi.php");
    $katalog = mysqli_query($conn,"SELECT katalog. *, katalog.nama FROM katalog
                                        ORDER BY id_katalog ASC");


?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>
</head>
<body>
    <center>
        <a href="index.php">Buku</a>
        <a href="penerbit.php">Katalog</a>
        <a href="pengarang.php">Pengarang</a>
        <a href="katalog.php">Katalog</a>
        <hr>
    </center>

    <a href="Add_katalog.php">Add New Katalog</a><br/><br/>
    <table width ="50%" border="1">

    <tr>
        <th>ID Katalog</th>
        <th>Nama Katalog</th>
        <th>Aksi</th>
        
    </tr>

    <?php
        while($katalog_data = mysqli_fetch_array($katalog)) {         
            echo "<tr>";
            echo "<td>".$katalog_data['id_katalog']."</td>";
            echo "<td>".$katalog_data['nama']."</td>";
            echo "<td><a class='btn btn-primary' href='edit_katalog.php?id_katalog=$katalog_data[id_katalog]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_katalog=$katalog_data[id_katalog]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>