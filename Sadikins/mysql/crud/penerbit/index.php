<?php 

    include_once('../config/connect.php');


    $penerbit = [];

    $result = $koneksi->query("SELECT * FROM penerbit");

    while ($each = $result->fetch_assoc()) {

        $penerbit[] = $each;
    }


    // echo "<pre>";
    // echo print_r($penerbit);
    // echo "<pre>";





 ?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerbit</title>
</head>

<body>

    <center>
        <a href="../buku/index.php">Buku</a> |
        <a href="..index.php">Penerbit</a> |
        <a href="../pengarang/index.php">Pengarang</a> |
        <a href="../katalog/index.php">Katalog</a>
        <hr>
    </center>


<a href="add.php">Add New Penerbit</a><br /><br />
    <table width='50%' border=1>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach($penerbit as $key => $value) : ?>

            <tr>
                <td><?php echo $key+1?></td>
                <td><?php echo $value['id_penerbit']?></td>
                <td><?php echo $value['nama_penerbit']?></td>
                <td><?php echo $value['email']?></td>
                <td><?php echo $value['telp']?></td>
                <td><?php echo $value['alamat']?></td>
                <td>
                    <a class='btn btn-primary' href='edit.php?id=<?php echo $value['id_penerbit'] ?>'>Edit</a> | <a class='btn btn-danger' href='delete.php?id=<?php echo $value['id_penerbit'] ?>'>Delete</a>
                </td>
            </tr>


        <?php endforeach ?>



        </tbody>
    </table>

</body>

</html>