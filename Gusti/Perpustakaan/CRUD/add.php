<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<title>Add Buku</title>
</head>

<?php
include_once("koneksi.php");
$penerbit = mysqli_query($conn, "SELECT * FROM penerbit");
$pengarang = mysqli_query($conn, "SELECT * FROM pengarang");
$katalog = mysqli_query($conn, "SELECT * FROM katalog");
?>

<body>
	<div class="container">
		<div class="main">
			<a href="index.php">Go to Home</a>
			<br /><br />

			<div class="card">
				<div class="card-header text-white bg-secondary">
					Tambah Buku
				</div>
				<div class="card-body">
					<form action="add.php" method="post" name="form1">
						<table border="0">
							<tr>
								<td>ISBN</td>
								<td><input type="text" name="isbn"></td>
							</tr>
							<tr>
								<td>Judul</td>
								<td><input type="text" name="judul"></td>
							</tr>
							<tr>
								<td>Tahun</td>
								<td><input type="text" name="tahun"></td>
							</tr>
							<tr>
								<td>Penerbit</td>
								<td>
									<select name="id_penerbit">
										<?php
										while ($penerbit_data = mysqli_fetch_array($penerbit)) {
											echo "<option value='" . $penerbit_data['id_penerbit'] . "'>" . $penerbit_data['nama_penerbit'] . "</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Pengarang</td>
								<td>
									<select name="id_pengarang">
										<?php
										while ($pengarang_data = mysqli_fetch_array($pengarang)) {
											echo "<option value='" . $pengarang_data['id_pengarang'] . "'>" . $pengarang_data['nama_pengarang'] . "</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Katalog</td>
								<td>
									<select name="id_katalog">
										<?php
										while ($katalog_data = mysqli_fetch_array($katalog)) {
											echo "<option value='" . $katalog_data['id_katalog'] . "'>" . $katalog_data['nama'] . "</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Qty Stok</td>
								<td><input type="text" name="qty_stok"></td>
							</tr>
							<tr>
								<td>Harga Pinjam</td>
								<td><input type="text" name="harga_pinjam"></td>
							</tr>
							<tr>
								<td></td>
								<td><input class="btn btn-success" type="submit" name="Submit" value="Add">
									<input class="btn btn-danger" type="reset" value="Reset">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php

	// Check If form submitted, insert form data into users table.
	if (isset($_POST['Submit'])) {
		$isbn = $_POST['isbn'];
		$judul = $_POST['judul'];
		$tahun = $_POST['tahun'];
		$id_penerbit = $_POST['id_penerbit'];
		$id_pengarang = $_POST['id_pengarang'];
		$id_katalog = $_POST['id_katalog'];
		$qty_stok = $_POST['qty_stok'];
		$harga_pinjam = $_POST['harga_pinjam'];

		include_once("koneksi.php");

		$result = mysqli_query($conn, "INSERT INTO `buku` (`isbn`, `judul`, `tahun`, `id_penerbit`, `id_pengarang`, `id_katalog`, `qty_stok`, `harga_pinjam`) VALUES ('$isbn', '$judul', '$tahun', '$id_penerbit', '$id_pengarang', '$id_katalog', '$qty_stok', '$harga_pinjam');");

		header("Location:index.php");
	}
	?>
</body>

</html>