<?php
include_once("koneksi.php");
$buku = mysqli_query($conn, "SELECT buku. *, nama_pengarang, nama_penerbit, katalog.nama as nama_katalog FROM buku
                                        LEFT JOIN pengarang ON pengarang.id_pengarang = buku.id_pengarang
                                        LEFT JOIN penerbit ON penerbit.id_penerbit = buku.id_penerbit
                                        LEFT JOIN katalog ON katalog.id_katalog = buku.id_katalog
                                        ORDER BY judul ASC");


?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Homepage</title>
</head>

<body>
    <div class="container-md" >
        
        <!-- <div class="Navigasi">
            <ul>
                <li><a href="index.php">Buku</a></li>
                <li><a href="penerbit.php">Penerbit</a></li>
                <li><a href="pengarang.php">Pengarang</a></li>
                <li><a href="katalog.php">Katalog</a></li>
            </ul>
        </div> -->
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Buku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="penerbit.php">Penerbit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pengarang.php">Pengarang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="katalog.php">Katalog</a>
            </li>
        </ul>
    
        <!-- <div class="container">  -->
        
        <a class='btn btn-warning' href="Add.php">Add New Buku</a><br /><br />

        <table class="table border border-dark table-bordered ">

            <tr class="table-dark">
                <th>ISBN</th>
                <th>Judul</th>
                <th>Tahun</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Katalog</th>
                <th>Stok</th>
                <th>Harga Pinjam</th>
                <th>Aksi</th>
            </tr>

            <?php
            while ($buku_data = mysqli_fetch_array($buku)) {
                echo "<tr>";
                echo "<td>" . $buku_data['isbn'] . "</td>";
                echo "<td>" . $buku_data['judul'] . "</td>";
                echo "<td>" . $buku_data['tahun'] . "</td>";
                echo "<td>" . $buku_data['nama_pengarang'] . "</td>";
                echo "<td>" . $buku_data['nama_penerbit'] . "</td>";
                echo "<td>" . $buku_data['nama_katalog'] . "</td>";
                echo "<td>" . $buku_data['qty_stok'] . "</td>";
                echo "<td>" . $buku_data['harga_pinjam'] . "</td>";
                echo "<td><a class='btn btn-primary' href='edit.php?isbn=$buku_data[isbn]'>Edit</a> | <a class='btn btn-danger' href='delete.php?isbn=$buku_data[isbn]'>Delete</a></td></tr>";
            }
            ?>
        </table>
        <!-- </div>     -->
    </div>
</body>

</html>