<?php 

include_once('../templates/header.php');
    
$katalog = [];

$result = $koneksi->query("SELECT * FROM katalog");

while ($each = $result->fetch_assoc()) {
    
    $katalog[] = $each;
}
    



 ?>

 <?php include_once('../templates/navbar.php') ?>


    <div class="d-flex justify-content-between p-3">
        
        <h3 class=""><i class="bi bi-file-earmark-binary"></i> Tambah Katalog </h3>

        <div>
            
        <?php include_once('../templates/btn-back.php') ?>
        </div>

    </div>  
    



    <form action="add.php" method="post" class="row p-5">

          <div class="mb-3 row">
            <label for="id_katalog" class="col-sm-2 col-form-label">ID Katalog</label>
            <div class="col-sm-10">
              <input type="text" name="id" class="form-control" placeholder="KG0..">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Katalogs</label>
            <div class="col-sm-10">
              <input type="text" name="nama" class="form-control" placeholder="Buku...">
            </div>
          </div>

          <div class="mt-3 row ">
               <?php include_once('../templates/btn-send.php') ?>
          </div>



    </form>

<?php 
    

    if(isset($_POST['Submit'])) {

        $id = $_POST['id'];

        $nama = $_POST['nama'];


        $result = $koneksi->query("INSERT INTO katalog (id_katalog, nama) VALUES ('$id','$nama')");


        include_once('../templates/alert.php');




    }


 ?>

<?php include_once('../templates/footer.php') ?>