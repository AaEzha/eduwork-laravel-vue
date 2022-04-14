
<?php

include_once('../templates/header.php');

$title = 'Buku';
$icon = 'journal-code';

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



<?php include_once('../templates/navbar.php') ?> 

<?php include_once('../templates/title.php') ?> 


    <table class="table table-hover table-bordered" width='80%'>
        <thead >
        <tr>
            <th>No.</th>
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
        </thead>
        <tbody>
        <?php foreach ($buku as $key => $value) : ?>
            <tr>
                <td> <?php echo $key+1 ?> </td>
                <td><?php echo $value['isbn'] ?></td>
                <td><?php echo $value['judul'] ?></td>
                <td><?php echo $value['tahun'] ?></td>
                <td><?php echo $value['nama_pengarang'] ?></td>
                <td><?php echo $value['nama_penerbit'] ?></td>
                <td><?php echo $value['nama_katalog'] ?></td>
                <td><?php echo $value['qty_stok'] ?></td>
                <td><?php echo $value['harga_pinjam'] ?></td>
                <td><a class='btn btn-sm btn-warning' href='edit.php?isbn=<?php echo $value['isbn'] ?>'><i class="bi bi-pencil-square"></i> Edit</a>  <a class='btn btn-sm btn-danger ms-2' href='delete.php?isbn=<?php echo $value['isbn'] ?>'><i class="bi bi-trash"></i> Delete</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    

<?php include_once('../templates/footer.php') ?>