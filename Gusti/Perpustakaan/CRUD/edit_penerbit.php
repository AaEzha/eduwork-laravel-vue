<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<title>Edit Penerbit</title>
</head>

<?php
include_once("koneksi.php");
$id_penerbit = $_GET['id_penerbit'];


$penerbit = mysqli_query($conn, "SELECT * FROM penerbit WHERE id_penerbit='$id_penerbit'");

while ($penerbit_data = mysqli_fetch_array($penerbit)) {
	$id_penerbit = $penerbit_data['id_penerbit'];
	$nama_penerbit = $penerbit_data['nama_penerbit'];
	$email = $penerbit_data['email'];
	$telp = $penerbit_data['telp'];
	$alamat = $penerbit_data['alamat'];
}
?>

<body>
	<div class="container">
		<a href="index.php">Go to Home</a>
		<br /><br />

		<div class="card">
			<div class="card-header text-white bg-secondary">
				Tambah Katalog
			</div>
			<div class="card-body">

				<form action="edit_penerbit.php?id_penerbit=<?php echo $id_penerbit; ?>" method="post">
					<table width="25%" border="0">
						<tr>
							<td>Id Penerbit</td>
							<td style="font-size: 11pt;"><?php echo $id_penerbit; ?> </td>
						</tr>
						<tr>
							<td>Nama Penerbit</td>
							<td><input type="text" name="nama_penerbit" value="<?php echo $nama_penerbit; ?>"></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input type="text" name="email" value="<?php echo $email; ?>"></td>
						</tr>
						<tr>
							<td>Telp</td>
							<td><input type="text" name="telp" value="<?php echo $telp; ?>"></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>

						</tr>
						<tr>
							<td></td>
							<td><input class="btn btn-success" type="submit" name="update" value="Update"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<?php

	// Check If form submitted, insert form data into users table.
	if (isset($_POST['update'])) {

		$id_penerbit = $_GET['id_penerbit'];
		$nama_penerbit = $_POST['nama_penerbit'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];

		include_once("koneksi.php");

		$result = mysqli_query($conn, "UPDATE penerbit SET nama_penerbit = '$nama_penerbit', email = '$email', telp = '$telp', alamat = '$alamat' WHERE id_penerbit = '$id_penerbit';");

		header("Location:index.php");
	}
	?>
</body>

</html>