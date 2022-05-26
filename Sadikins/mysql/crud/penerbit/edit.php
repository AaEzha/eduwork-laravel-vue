<?php 

	include_once('../templates/header.php');
	
	$id_penerbit = $_GET['id'];

	$result = $koneksi->query("SELECT * FROM penerbit WHERE id_penerbit='$id_penerbit' ");


	while ($penerbit_data = $result->fetch_assoc()) {

		$id_penerbit = $penerbit_data['id_penerbit'];
		$nama_penerbit = $penerbit_data['nama_penerbit'];
		$email = $penerbit_data['email'];
		$telp = $penerbit_data['telp'];
		$alamat = $penerbit_data['alamat'];
		
	}



 ?>



 	<?php include_once('../templates/navbar.php') ?>

 	<div class="d-flex justify-content-between p-3">
 	    
 	    <h3 class=""><i class="bi bi-building"></i> Edit Penerbit </h3>

 	    <div>
 	        
 	    <?php include_once('../templates/btn-back.php') ?>
 	    </div>

 	</div>  
 	<form action="edit.php?id=<?php echo $id_penerbit; ?>" method="post" class="row p-5">

 	    <div class="mb-3 row">
 	       <label for="id_katalog" class="col-sm-2 col-form-label">ID Penerbit</label>
 	       <div class="col-sm-10">
 	         <input type="text" name="id" class="form-control" value="<?php echo $id_penerbit; ?>" disabled>
 	       </div>
 	     </div>
 	     <div class="mb-3 row">
 	       <label for="nama" class="col-sm-2 col-form-label">Nama Penerbit</label>
 	       <div class="col-sm-10">
 	         <input type="text" name="nama" class="form-control" value="<?php echo $nama_penerbit; ?>">
 	       </div>
 	     </div>

 	     <div class="mb-3 row">
 	       <label for="email" class="col-sm-2 col-form-label">Email</label>
 	       <div class="col-sm-10">
 	         <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
 	       </div>
 	     </div>

 	    
 	     <div class="mb-3 row">
 	       <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
 	       <div class="col-sm-10">
 	         <input type="text" name="telp" class="form-control" value="<?php echo $telp; ?>">
 	       </div>
 	     </div>

 	     <div class="mb-3 row">
 	       <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
 	       <div class="col-sm-10">
 	         <input type="text" name="alamat" class="form-control" value="<?php echo $alamat; ?>">
 	       </div>
 	     </div>


 	     <div class="mt-3 row ">
 	          <?php include_once('../templates/btn-update.php') ?>
 	     </div>

	 </form>
 	<?php

 	// Check If form submitted, insert form data into users table.
 	if (isset($_POST['update'])) {

 	    $id_penerbit = $_GET['id'];
 	    $nama_penerbit = $_POST['nama'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];
 	   

 	    include_once("../config/connect.php");

 	    $result = $koneksi->query("UPDATE penerbit SET nama_penerbit = '$nama_penerbit', email = '$email', telp = '$telp', alamat = '$alamat'  WHERE id_penerbit = '$id_penerbit';");

 	    include_once('../templates/alert.php');
 	}
 	?>
 	
 <?php include_once('../templates/footer.php') ?>
