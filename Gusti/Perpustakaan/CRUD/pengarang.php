<?php
    include_once("koneksi.php");
    $pengarang = mysqli_query($conn,"SELECT pengarang. *, nama_pengarang, pengarang.email, pengarang.telp, pengarang.alamat FROM pengarang
                                        ORDER BY nama_pengarang ASC");


?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengarang</title>
</head>
<body>
    <center>
        <a href="index.php">Buku</a>
        <a href="penerbit.php">Penerbit</a>
        <a href="pengarang.php">Pengarang</a>
        <a href="katalog.php">Katalog</a>
        <hr>
    </center>

    <a href="Add_pengarang.php">Add New Pengarang</a><br/><br/>
    <table width ="80%" border="1">

    <tr>
        <th>ID Pengarang</th>
        <th>Nama Pengarang</th>
        <th>Email</th>
        <th>Tlp</th>
        <th>Alamat</th>
        <th>Aksi</th>
        
    </tr>

    <?php
        while($pengarang_data = mysqli_fetch_array($pengarang)) {         
            echo "<tr>";
            echo "<td>".$pengarang_data['id_pengarang']."</td>";
            echo "<td>".$pengarang_data['nama_pengarang']."</td>";
            echo "<td>".$pengarang_data['email']."</td>";    
            echo "<td>".$pengarang_data['telp']."</td>";    
            echo "<td>".$pengarang_data['alamat']."</td>";    
            echo "<td><a class='btn btn-primary' href='edit_pengarang.php?id_pengarang=$pengarang_data[id_pengarang]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_pengarang=$pengarang_data[id_pengarang]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>