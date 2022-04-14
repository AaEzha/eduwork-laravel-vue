


<?php

include_once('../templates/header.php');



$isbn = $_GET['isbn'];

$buku = $koneksi->query("SELECT * FROM buku WHERE isbn='$isbn'");
$penerbit = $koneksi->query("SELECT * FROM penerbit");
$pengarang = $koneksi->query("SELECT * FROM pengarang");
$katalog = $koneksi->query("SELECT * FROM katalog");

while ($buku_data = $buku->fetch_assoc()) {
	$judul = $buku_data['judul'];
	$isbn = $buku_data['isbn'];
	$tahun = $buku_data['tahun'];
	$id_penerbit = $buku_data['id_penerbit'];
	$id_pengarang = $buku_data['id_pengarang'];
	$id_katalog = $buku_data['id_katalog'];
	$qty_stok = $buku_data['qty_stok'];
	$harga_pinjam = $buku_data['harga_pinjam'];
}
?>





<?php include_once('../templates/navbar.php') ?>
	
	<div class="d-flex justify-content-between p-3">
		
		<h3 class=""><i class="bi bi-journal-code"></i> Edit Buku </h3>

		<div>
			
		<?php include_once('../templates/btn-back.php') ?>
		</div>

	</div>	

	<form action="edit.php?isbn=<?php echo $isbn; ?>" method="post" class="row p-5">
		

		<div class="col-md-6 mb-4">
			<label for="" class="form-label">ISBN</label>
			<input type="text" name="isbn" class="form-control " placeholder="ISBN" value="<?php echo $isbn; ?>" disabled>
		</div> 
		
		<div class=" col-md-6 mb-4">
			<label for="" class="form-label">Judul</label>
			<input type="text" name="judul" class="form-control" placeholder="Judul Buku" value="<?php echo $judul; ?>">
		</div>
		
		<div class=" col-md-6 mb-4"> 
			<label for="" class="form-label">Tahun</label>
			<input type="text" name="tahun" class="form-control" placeholder="Tahun (2009)" value="<?php echo $tahun; ?>" >
		</div>
		
		<div class="col-md-6 mb-4">
			
			<label for="" class="form-label">Penerbit</label>
			
			<select name="id_penerbit" class="form-select" >
					
					<?php
						while ($penerbit_data = $penerbit->fetch_assoc()) {
							echo "<option " . ($penerbit_data['id_penerbit'] == $id_penerbit ? 'selected' : '') . " value='" . $penerbit_data['id_penerbit'] . "'>" . $penerbit_data['nama_penerbit'] . "</option>";
						}
						?>
			</select>
		</div>
			
		
		<div class="col-md-6 mb-4"> 
			<label for="" class="form-label">Pengarang</label>
			
			<select name="id_pengarang" class="form-select" >
				<?php
					while ($pengarang_data = $pengarang->fetch_assoc()) {
						echo "<option " . ($pengarang_data['id_pengarang'] == $id_pengarang ? 'selected' : '') . " value='" . $pengarang_data['id_pengarang'] . "'>" . $pengarang_data['nama_pengarang'] . "</option>";
					}
				?>
			</select>
			
		</div>
		<div class="col-md-6 mb-4"> 
			<label for="" class="form-label">Katalog</label>
			
			<select name="id_katalog" class="form-select" >
				<?php
				while ($katalog_data = $katalog->fetch_assoc()) {
					echo "<option " . ($katalog_data['id_katalog'] == $id_katalog ? 'selected' : '') . " value='" . $katalog_data['id_katalog'] . "'>" . $katalog_data['nama'] . "</option>";
				}
				?>
			</select>
			
		</div>

		<div class="col-md-6 mb-4"> 
			<label for="" class="form-label">Qty Stok</label>
			<input type="text" name="qty_stok" class="form-control" placeholder="Qty Stok" value="<?php echo $qty_stok; ?>">
		</div>

		<div class="col-md-6 mb-5"> 
			<label for="" class="form-label">Harga Pinjam</label>
			<input type="text" name="harga_pinjam" class="form-control" placeholder="Harga Pinjam" value="<?php echo $harga_pinjam; ?>" >
		</div>

			<?php include_once('../templates/btn-update.php') ?>
	</form>

	<?php

	// Check If form submitted, insert form data into users table.
	if (isset($_POST['update'])) {

		$isbn = $_GET['isbn'];
		$judul = $_POST['judul'];
		$tahun = $_POST['tahun'];
		$id_penerbit = $_POST['id_penerbit'];
		$id_pengarang = $_POST['id_pengarang'];
		$id_katalog = $_POST['id_katalog'];
		$qty_stok = $_POST['qty_stok'];
		$harga_pinjam = $_POST['harga_pinjam'];

	

		$result = $koneksi->query("UPDATE buku SET judul = '$judul', tahun = '$tahun', id_penerbit = '$id_penerbit', id_pengarang = '$id_pengarang', id_katalog = '$id_katalog', qty_stok = '$qty_stok', harga_pinjam = '$harga_pinjam' WHERE isbn = '$isbn';");

		include_once('../templates/alert.php');
	}
	?>
</body>

</html>