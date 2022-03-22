<?php
    include_once("connect.php");
    $buku = mysqli_query($mysqli, "SELECT * FROM buku ");
?>
 
<html>
<head>    
    <title>Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
 
<body>

<center>
    <a href=buku.php>Buku</a> |
    <a href="penerbit.php">Penerbit</a> |
    <a href="pengarang.php">Pengarang</a> |
    <a href="katalog.php">Katalog</a>
    <hr>
</center>

<a href="add.php">Add New Buku</a><br/><br/>
 
    <table class="table" width='80%' border=1>
 
    <tr>
        <th>ISBN</th> 
        <th>Judul</th> 
        <th>Tahun</th> 
        <th>Penerbit</th>
        <th>Pengarang</th>
        <th>Katalog</th>
        <th>Stok</th>
        <th>Harga Pinjam</th>
        <th>Aksi</th>
    </tr>
    <?php  
        while($buku_data = mysqli_fetch_array($buku)) {         
            echo "<tr>";
            echo "<td>".$buku_data['isbn']."</td>";
            echo "<td>".$buku_data['judul']."</td>";
            echo "<td>".$buku_data['tahun']."</td>";    
            echo "<td>".$buku_data['id_penerbit']."</td>";    
            echo "<td>".$buku_data['id_pengarang']."</td>";    
            echo "<td>".$buku_data['id_katalog']."</td>";    
            echo "<td>".$buku_data['qty_stok']."</td>";    
            echo "<td>".$buku_data['harga_pinjam']."</td>";    
            echo "<td><a class='btn btn-primary' href='edit.php?isbn=$buku_data[isbn]'>Edit</a> | <a class='btn btn-danger' href='delete.php?isbn=$buku_data[isbn]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>