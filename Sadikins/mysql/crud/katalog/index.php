<?php
include_once("../config/connect.php");

$title = 'Katalog';
$icon = 'file-earmark-binary';

$katalog = [];
$result = $koneksi->query("SELECT * FROM katalog");

while ($each = $result->fetch_assoc()) {

    $katalog[] = $each;
}

?>

<?php include_once('../templates/header.php') ?>
<?php include_once('../templates/navbar.php') ?>
<?php include_once('../templates/title.php') ?>

    <table width='50%' class="table table-hover table-bordered">
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
                    <td>
                        <a class='btn btn-sm btn-warning me-2' href='edit.php?id=<?php echo $value['id_katalog'] ?>'><i class="bi bi-pencil-square"></i> Edit</a> 
                         
                        <a class='btn btn-sm btn-danger' href='delete.php?id=<?php echo $value['id_katalog'] ?>'><i class="bi bi-trash"></i> Delete</a></td>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>


<?php include_once('../templates/footer.php') ?>