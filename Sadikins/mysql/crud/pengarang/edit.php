<?php 

	include_once('../templates/header.php');
	
	$id_pengarang = $_GET['id'];

	$result = $koneksi->query("SELECT * FROM pengarang WHERE id_pengarang='$id_pengarang' ");


	while ($pengarang_data = $result->fetch_assoc()) {

		$id_pengarang = $pengarang_data['id_pengarang'];
		$nama_pengarang = $pengarang_data['nama_pengarang'];
		$email = $pengarang_data['email'];
		$telp = $pengarang_data['telp'];
		$alamat = $pengarang_data['alamat'];
		
	}



 ?>


 <?php include_once('../templates/navbar.php') ?>

 <div class="d-flex justify-content-between p-3">
     
     <h3 class=""><i class="bi bi-person-bounding-box"></i> Edit Pengarang </h3>

     <div>
         
     <?php include_once('../templates/btn-back.php') ?>
     </div>

 </div>  



 	<form action="edit.php?id=<?php echo $id_pengarang; ?>" method="post" class="row p-5">

 	    <div class="mb-3 row">
 	       <label for="id_katalog" class="col-sm-2 col-form-label">ID Pengarang</label>
 	       <div class="col-sm-10">
 	         <input type="text" name="id" class="form-control" disabled value="<?php echo $id_pengarang; ?>">
 	       </div>
 	     </div>
 	     <div class="mb-3 row">
 	       <label for="nama" class="col-sm-2 col-form-label">Nama Pengarang</label>
 	       <div class="col-sm-10">
 	         <input type="text" name="nama" class="form-control" value="<?php echo $nama_pengarang; ?>">
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

 	    $id_pengarang = $_GET['id'];
 	    $nama_pengarang = $_POST['nama'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];
 	   

 	    include_once("../config/connect.php");

 	    $result = $koneksi->query("UPDATE pengarang SET nama_pengarang = '$nama_pengarang', email = '$email', telp = '$telp', alamat = '$alamat'  WHERE id_pengarang = '$id_pengarang';");

 	    include_once('../templates/alert.php');
 	}
 	?>
 	
 </body>
 </html>