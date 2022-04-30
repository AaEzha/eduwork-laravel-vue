<?php
    include_once("connect.php");
    $penerbit = mysqli_query($conn, "SELECT * FROM `penerbit`");
?>
 
<html>
<head>    
    <title>Penerbit</title>
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

<a href="penerbit_add.php" class="btn btn-primary mb-3">Add New Penerbit</a>
 
    <table class="table text-center" width='80%' border=1>
 
    <tr>
        <th>Nama Penerbit</th>
        <th>Id Penerbit</th>
        <th>Email</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Opsi</th>
    </tr>
    <?php  
        while($penerbitData = mysqli_fetch_array($penerbit)) {         
            echo "<tr>";
            echo "<td>".$penerbitData['nama_penerbit']."</td>";    
            echo "<td>".$penerbitData['id_penerbit']."</td>";  
            echo "<td>".$penerbitData['email']."</td>";    
            echo "<td>".$penerbitData['telp']."</td>";    
            echo "<td>".$penerbitData['alamat']."</td>";    
            echo "<td><a class='badge badge-primary' href='penerbit_edit.php?id_penerbit=$penerbitData[id_penerbit]'>Edit</a> | <a class='badge badge-danger' href='penerbit_delete.php?id_penerbit=$penerbitData[id_penerbit]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>