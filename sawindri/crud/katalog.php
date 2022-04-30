<?php
    include_once("connect.php");
    $katalog = mysqli_query($conn, "SELECT * FROM `katalog` GROUP BY id_katalog ASC");
?>
 
<html>
<head>    
    <title>Katalog</title>
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

<a href="katalog_add.php" class="btn btn-primary mb-3">Add New Katalog</a>
 
    <table class="table text-center" width='80%' border=1>
 
    <tr>
        <th>Id Katalog</th>
        <th>Nama Katalog</th>
        <th>Opsi</th>
    </tr>
    <?php  
        while($katalogData = mysqli_fetch_array($katalog)) {         
            echo "<tr>";
            echo "<td>".$katalogData['id_katalog']."</td>";
            echo "<td>".$katalogData['nama']."</td>";   
            echo "<td><a class='badge badge-primary' href='katalog_edit.php?id_katalog=$katalogData[id_katalog]'>Edit</a> | <a class='badge badge-danger' href='katalog_delete.php?id_katalog=$katalogData[id_katalog]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>