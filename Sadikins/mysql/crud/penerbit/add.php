<?php

include_once('../templates/header.php');
    
$penerbit = [];

$result = $koneksi->query("SELECT * FROM penerbit");

while ($each = $result->fetch_assoc()) {
    
    $penerbit[] = $each;
}
    



 ?>


 <?php include_once('../templates/navbar.php') ?>


    <div class="d-flex justify-content-between p-3">
        
        <h3 class=""><i class="bi bi-building"></i> Tambah Penerbit </h3>

        <div>
            
        <?php include_once('../templates/btn-back.php') ?>
        </div>

    </div>  




    <form action="add.php" method="post" class="row p-5">

        <div class="mb-3 row">
           <label for="id_katalog" class="col-sm-2 col-form-label">ID Penerbit</label>
           <div class="col-sm-10">
             <input type="text" name="id" class="form-control" placeholder="PN0..">
           </div>
         </div>
         <div class="mb-3 row">
           <label for="nama" class="col-sm-2 col-form-label">Nama Penerbit</label>
           <div class="col-sm-10">
             <input type="text" name="nama" class="form-control" placeholder="Nama...">
           </div>
         </div>

         <div class="mb-3 row">
           <label for="email" class="col-sm-2 col-form-label">Email</label>
           <div class="col-sm-10">
             <input type="text" name="email" class="form-control" placeholder="Email...">
           </div>
         </div>

        
         <div class="mb-3 row">
           <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
           <div class="col-sm-10">
             <input type="text" name="telp" class="form-control" placeholder="Telepon...">
           </div>
         </div>

         <div class="mb-3 row">
           <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
           <div class="col-sm-10">
             <input type="text" name="alamat" class="form-control" placeholder="Alamat...">
           </div>
         </div>


         <div class="mt-3 row ">
              <?php include_once('../templates/btn-send.php') ?>
         </div>

    </form>

        <?php 


        if(isset($_POST['Submit']))
        {
        	$id = $_POST['id'];
        	$nama = $_POST['nama'];
        	$email = $_POST['email'];
        	$telp = $_POST['telp'];
        	$alamat = $_POST['alamat'];

        	$result = $koneksi->query("INSERT INTO penerbit (id_penerbit, nama_penerbit, email, telp, alamat) VALUES('$id', '$nama', '$email', '$telp', '$alamat')");

        	include_once('../templates/alert.php');

        }




         ?>

	
</body>
</html>