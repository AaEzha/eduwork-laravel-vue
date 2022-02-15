<?php
include_once("koneksi.php");
$pengarang = mysqli_query($conn, "SELECT pengarang. *, nama_pengarang, pengarang.email, pengarang.telp, pengarang.alamat FROM pengarang
                                        ORDER BY nama_pengarang ASC");


?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Pengarang</title>
</head>

<body>
    <div class="container">
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

        <a class="btn btn-warning" href="Add_pengarang.php">Add New Pengarang</a><br /><br />

        <table class="table border border-dark table-bordered ">

            <tr class="table-dark">

                <th>ID Pengarang</th>
                <th>Nama Pengarang</th>
                <th>Email</th>
                <th>Tlp</th>
                <th>Alamat</th>
                <th>Aksi</th>

            </tr>

            <?php
            while ($pengarang_data = mysqli_fetch_array($pengarang)) {
                echo "<tr>";
                echo "<td>" . $pengarang_data['id_pengarang'] . "</td>";
                echo "<td>" . $pengarang_data['nama_pengarang'] . "</td>";
                echo "<td>" . $pengarang_data['email'] . "</td>";
                echo "<td>" . $pengarang_data['telp'] . "</td>";
                echo "<td>" . $pengarang_data['alamat'] . "</td>";
                echo "<td><a class='btn btn-primary' href='edit_pengarang.php?id_pengarang=$pengarang_data[id_pengarang]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_pengarang=$pengarang_data[id_pengarang]'>Delete</a></td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>