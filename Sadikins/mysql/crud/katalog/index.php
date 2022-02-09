<?php
include_once("../config/connect.php");
$katalog = [];
$result = $koneksi->query("SELECT * FROM katalog");

while ($each = $result->fetch_assoc()) {

    $katalog[] = $each;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>
</head>

<body>
    <center>
        <a href="../buku/index.php">Buku</a> |
        <a href="../penerbit/index.php">Penerbit</a> |
        <a href="../pengarang/index.php">Pengarang</a> |
        <a href="katalog/index.php">Katalog</a>
        <hr>
    </center>
    <a href="add.php">Add New Katalog</a><br /><br />

    <table width='50%' border=1>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Katalog</th>
                <th>Nama Katalog</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($katalog as $key => $value) : ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><?php echo $value['id_katalog'] ?> </td>
                    <td><?php echo $value['nama'] ?></td>
                    <td><a class='btn btn-primary' href='edit.php?id=<?php echo $value['id_katalog'] ?>'>Edit</a> | <a class='btn btn-danger' href='delete.php?id=<?php echo $value['id_katalog'] ?>'>Delete</a></td>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>

</html>