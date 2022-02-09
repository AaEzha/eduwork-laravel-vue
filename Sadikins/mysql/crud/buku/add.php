
<?php
	include_once('../templates/header.php');
    $penerbit =$koneksi->query("SELECT * FROM penerbit");
    $pengarang =$koneksi->query("SELECT * FROM pengarang");
    $katalog =$koneksi->query("SELECT * FROM katalog");
?>


<?php include_once('../templates/navbar.php') ?>


	<div class="d-flex justify-content-between p-3">
		
		<h3 class=""><i class="bi bi-journal-code"></i> Tambah Buku </h3>

		<div>
			
		<?php include_once('../templates/btn-back.php') ?>
		</div>

	</div>	
 	

 
	<form action="add.php" method="post" name="form1" class="row p-5">

		
			<div class="col-md-6 mb-4">
				<label for="" class="form-label">ISBN</label>
				<input type="text" name="isbn" class="form-control" placeholder="ISBN" required>
			</div> 
			
			<div class=" col-md-6 mb-4">
				<label for="" class="form-label">Judul</label>
				<input type="text" name="judul" class="form-control" placeholder="Judul Buku" required>
			</div>
		
			<div class=" col-md-6 mb-4"> 
				<label for="" class="form-label">Tahun</label>
				<input type="text" name="tahun" class="form-control" placeholder="Tahun (2009) " required>
			</div>
			
			<div class="col-md-6 mb-4">
				
				<label for="" class="form-label">Penerbit</label>
				
				<select name="id_penerbit" class="form-select" required>
						<option> Pilih Penerbit </option>
						<?php 
						    while($penerbit_data =$penerbit->fetch_assoc()) {         
						    	echo "<option value='".$penerbit_data['id_penerbit']."'>".$penerbit_data['nama_penerbit']."</option>";
						    }
						?>
				</select>
			</div>
				
			
			<div class="col-md-6 mb-4"> 
				<label for="" class="form-label">Pengarang</label>
				
				<select name="id_pengarang" class="form-select" required>
					<option> Pilih Pengarang </option>
					<?php 
					    while($pengarang_data =$pengarang->fetch_assoc()) {         
					    	echo "<option value='".$pengarang_data['id_pengarang']."'>".$pengarang_data['nama_pengarang']."</option>";
					    }
					?>
				</select>
				
			</div>
			<div class="col-md-6 mb-4"> 
				<label for="" class="form-label">Katalog</label>
				
				<select name="id_katalog" class="form-select" required>
					<option> Pilih Katalog </option>
					<?php 
					    while($katalog_data =$katalog->fetch_assoc()) {         
					    	echo "<option value='".$katalog_data['id_katalog']."'>".$katalog_data['nama']."</option>";
					    }
					?>
				</select>
				
			</div>

			<div class="col-md-6 mb-4"> 
				<label for="" class="form-label">Qty Stok</label>
				<input type="text" name="qty_stok" class="form-control" placeholder="Qty Stok">
			</div>

			<div class="col-md-6 mb-5"> 
				<label for="" class="form-label">Harga Pinjam</label>
				<input type="text" name="harga_pinjam" class="form-control" placeholder="Harga Pinjam" required>
			</div>

				<?php include_once('../templates/btn-send.php') ?>
			
	
	</form>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['Submit'])) {
			$isbn = $_POST['isbn'];
			$judul = $_POST['judul'];
			$tahun = $_POST['tahun'];
			$id_penerbit = $_POST['id_penerbit'];
			$id_pengarang = $_POST['id_pengarang'];
			$id_katalog = $_POST['id_katalog'];
			$qty_stok = $_POST['qty_stok'];
			$harga_pinjam = $_POST['harga_pinjam'];
			

			$result =$koneksi->query("INSERT INTO `buku` (`isbn`, `judul`, `tahun`, `id_penerbit`, `id_pengarang`, `id_katalog`, `qty_stok`, `harga_pinjam`) VALUES ('$isbn', '$judul', '$tahun', '$id_penerbit', '$id_pengarang', '$id_katalog', '$qty_stok', '$harga_pinjam');");
			
			include_once('../templates/alert.php');
		}
	?>

<?php include_once('../templates/footer.php') ?>