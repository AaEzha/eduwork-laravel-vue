<?php
include_once("../config/connect.php");
$buku = [];
$result = $koneksi->query("SELECT buku.*, nama_pengarang, nama_penerbit, katalog.nama as nama_katalog FROM buku 
                                        LEFT JOIN  pengarang ON pengarang.id_pengarang = buku.id_pengarang
                                        LEFT JOIN  penerbit ON penerbit.id_penerbit = buku.id_penerbit
                                        LEFT JOIN  katalog ON katalog.id_katalog = buku.id_katalog
                                        ORDER BY judul ASC");

while ($each = $result->fetch_assoc()) {
    $buku[] = $each;
}

?>

<html>

<head>
    <title>Homepage</title>
</head>

<body>

    <center>
        <a href="index.php">Buku</a> |
        <a href="../penerbit/index.php">Penerbit</a> |
        <a href="../pengarang/index.php">Pengarang</a> |
        <a href="../katalog/index.php">Katalog</a>
        <hr>
    </center>

    <a href="add.php">Add New Buku</a><br /><br />

    <table class="table" width='80%' border=1>

        <tr>
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
        <?php foreach ($buku as $key => $value) : ?>
            <tr>
                <td><?php echo $value['isbn'] ?></td>
                <td><?php echo $value['judul'] ?></td>
                <td><?php echo $value['tahun'] ?></td>
                <td><?php echo $value['nama_pengarang'] ?></td>
                <td><?php echo $value['nama_penerbit'] ?></td>
                <td><?php echo $value['nama_katalog'] ?></td>
                <td><?php echo $value['qty_stok'] ?></td>
                <td><?php echo $value['harga_pinjam'] ?></td>
                <td><a class='btn btn-primary' href='edit.php?isbn=<?php echo $value['isbn'] ?>'>Edit</a> | <a class='btn btn-danger' href='delete.php?isbn=<?php echo $value['isbn'] ?>'>Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>