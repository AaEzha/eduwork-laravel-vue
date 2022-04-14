<?php 


include_once('../config/connect.php');

$title = 'Pengarang';
$icon = 'person-bounding-box';


$pengarang = [];


$result = $koneksi->query("SELECT * FROM pengarang");

while ($each = $result->fetch_assoc()) {
    
    $pengarang[] = $each;
}



 ?>



<?php include_once('../templates/header.php') ?>

<?php include_once('../templates/navbar.php') ?>

<?php include_once('../templates/title.php') ?>



    <table class="table table-hover table-bordered" width='50%' >
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
                    <a class='btn btn-sm btn-warning me-2' href='edit.php?id=<?php echo $value['id_pengarang'] ?>'><i class="bi bi-pencil-square"></i> Edit</a>  <a class='btn btn-sm btn-danger' href='delete.php?id=<?php echo $value['id_pengarang'] ?>'><i class="bi bi-trash"></i> Delete</a>
                </td>
            </tr>


        <?php endforeach ?>


<?php include_once('../templates/footer.php') ?>