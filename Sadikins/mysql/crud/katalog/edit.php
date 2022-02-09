<?php

include_once('../templates/header.php');

$id_katalog = $_GET['id'];


$result = $koneksi->query("SELECT * FROM katalog WHERE id_katalog='$id_katalog' ");

while ($katalog_data = $result->fetch_assoc()) {

    $id_katalog = $katalog_data['id_katalog'];
    $nama = $katalog_data['nama'];
}



?>

<?php include_once('../templates/navbar.php') ?>

<div class="d-flex justify-content-between p-3">
    
    <h3 class=""><i class="bi bi-file-earmark-binary"></i> Edit Katalog </h3>

    <div>
        
    <?php include_once('../templates/btn-back.php') ?>
    </div>

</div>  


    <form action="edit.php?id=<?php echo $id_katalog; ?>" method="post" class="row p-5">

        <div class="mb-3 row">
          <label for="id_katalog" class="col-sm-2 col-form-label">ID Katalog</label>
          <div class="col-sm-10">
            <input type="text" name="id" class="form-control" value="<?php echo $id_katalog; ?>" >
          </div>
        </div>
        <div class="mb-3 row">
          <label for="nama" class="col-sm-2 col-form-label">Nama Katalogs</label>
          <div class="col-sm-10">
            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
          </div>
        </div>

        <div class="mt-3 row ">
         
             <?php include_once('../templates/btn-update.php') ?>
        </div>


    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if (isset($_POST['update'])) {

        $id_katalog = $_GET['id'];
        $nama = $_POST['nama'];
       

        include_once("../config/connect.php");

        $result = $koneksi->query("UPDATE katalog SET nama = '$nama' WHERE id_katalog = '$id_katalog';");

        include_once('../templates/alert.php');
    }
    ?>
    
</body>
</html>
