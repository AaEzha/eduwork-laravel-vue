<?php 


include_once('../config/connect.php');



$pengarang = [];


$result = $koneksi->query("SELECT * FROM pengarang");

while ($each = $result->fetch_assoc()) {
    
    $pengarang[] = $each;
}


    // echo "<pre>";
    // echo print_r($pengarang);
    // echo "<pre>";




 ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengarang</title>
</head>

<body>

      <center>
        <a href="../buku/index.php">Buku</a> |
        <a href="../penerbit/index.php">Penerbit</a> |
        <a href="index.php">Pengarang</a> |
        <a href="../katalog/index.php">Katalog</a>
        <hr>
    </center>


<a href="add.php">Add New Pengarang</a><br /><br />
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

            <?php foreach($pengarang as $key => $value) : ?>

            <tr>
                <td><?php echo $key+1?></td>
                <td><?php echo $value['id_pengarang']?></td>
                <td><?php echo $value['nama_pengarang']?></td>
                <td><?php echo $value['email']?></td>
                <td><?php echo $value['telp']?></td>
                <td><?php echo $value['alamat']?></td>
                <td>
                    <a class='btn btn-primary' href='edit.php?id=<?php echo $value['id_pengarang'] ?>'>Edit</a> | <a class='btn btn-danger' href='delete.php?id=<?php echo $value['id_pengarang'] ?>'>Delete</a>
                </td>
            </tr>


        <?php endforeach ?>



</body>

</html>