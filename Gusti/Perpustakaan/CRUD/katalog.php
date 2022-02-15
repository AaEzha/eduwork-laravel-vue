<?php
include_once("koneksi.php");
$katalog = mysqli_query($conn, "SELECT katalog. *, katalog.nama FROM katalog
                                        ORDER BY id_katalog ASC");


?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Katalog</title>
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

        <a class="btn btn-warning" href="Add_katalog.php">Add New Katalog</a><br /><br />
        <table class="table border border-dark table-bordered" >
            
            <tr class="table-dark">
                <th>ID Katalog</th>
                <th>Nama Katalog</th>
                <th>Aksi</th>

            </tr>

            <?php
            while ($katalog_data = mysqli_fetch_array($katalog)) {
                echo "<tr>";
                echo "<td>" . $katalog_data['id_katalog'] . "</td>";
                echo "<td>" . $katalog_data['nama'] . "</td>";
                echo "<td><a class='btn btn-primary' href='edit_katalog.php?id_katalog=$katalog_data[id_katalog]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_katalog=$katalog_data[id_katalog]'>Delete</a></td></tr>";
            }
            ?>
        </table>
</body>

</html>