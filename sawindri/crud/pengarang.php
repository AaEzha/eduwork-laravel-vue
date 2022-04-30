<?php
    include_once("connect.php");
    $pengarang = mysqli_query($conn, "SELECT * FROM `pengarang` GROUP BY id_pengarang ASC");
?>
 
<html>
<head>    
    <title>Pengarang</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
 
<body>

<center>
    <a href="index.php">Buku</a> |
    <a href="penerbit.php">Penerbit</a> |
    <a href="pengarang.php">Pengarang</a> |
    <a href="katalog.php">Katalog</a>
    <hr>
</center>

<a href="pengarang_add.php" class="btn btn-primary mb-3">Add New Pengarang</a>
 
    <table class="table text-center" width='80%' border=1>
 
    <tr>
        <th>Id Pengarang</th>
        <th>Nama Pengarang</th>
        <th>Email</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    <?php  
        while($pengarangData = mysqli_fetch_array($pengarang)) {         
            echo "<tr>";
            echo "<td>".$pengarangData['id_pengarang']."</td>";
            echo "<td>".$pengarangData['nama_pengarang']."</td>";
            echo "<td>".$pengarangData['email']."</td>";    
            echo "<td>".$pengarangData['telp']."</td>";    
            echo "<td>".$pengarangData['alamat']."</td>";     
            echo "<td><a class='badge badge-primary' href='pengarang_edit.php?id_pengarang=$pengarangData[id_pengarang]'>Edit</a> | <a class='badge badge-danger' href='pengarang_delete.php?id_pengarang=$pengarangData[id_pengarang]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>