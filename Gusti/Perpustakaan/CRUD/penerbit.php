<?php
    include_once("koneksi.php");
    $penerbit = mysqli_query($conn,"SELECT penerbit. *, nama_penerbit, penerbit.email, penerbit.telp, penerbit.alamat FROM penerbit
                                        ORDER BY nama_penerbit ASC");


?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerbit</title>
</head>
<body>
    <center>
        <a href="index.php">Buku</a>
        <a href="penerbit.php">Penerbit</a>
        <a href="pengarang.php">Pengarang</a>
        <a href="katalog.php">Katalog</a>
        <hr>
    </center>

    <a href="Add_penerbit.php">Add New Penerbit</a><br/><br/>
    <table width ="80%" border="1">

    <tr>
        <th>ID Penerbit</th>
        <th>Nama Penerbit</th>
        <th>Email</th>
        <th>Tlp</th>
        <th>Alamat</th>
        <th>Aksi</th>
        
    </tr>

    <?php
        while($penerbit_data = mysqli_fetch_array($penerbit)) {         
            echo "<tr>";
            echo "<td>".$penerbit_data['id_penerbit']."</td>";
            echo "<td>".$penerbit_data['nama_penerbit']."</td>";
            echo "<td>".$penerbit_data['email']."</td>";    
            echo "<td>".$penerbit_data['telp']."</td>";    
            echo "<td>".$penerbit_data['alamat']."</td>";    
            echo "<td><a class='btn btn-primary' href='edit_penerbit.php?id_penerbit=$penerbit_data[id_penerbit]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_penerbit=$penerbit_data[id_penerbit]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>