<html>

<head>
	<title>Add Penerbit</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>

<?php
include_once("koneksi.php");
$penerbit = mysqli_query($conn, "SELECT * FROM penerbit");
?>

<body>
	<div class="container-md">
		<a href="index.php">Go to Home</a>
		<br /><br />
		<div class="card">
			<div class="card-header text-white bg-secondary">
				Tambah Penerbit
			</div>
			<div class="card-body">
				<form action="add_penerbit.php" method="post" name="form1">
					<table border="0">
						<tr>
							<td>Id Penerbit</td>
							<td><input type="text" name="id_penerbit"></td>
						</tr>
						<tr>
							<td>Nama Penerbit</td>
							<td><input type="text" name="nama_penerbit"></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input type="text" name="email"></td>
						</tr>

						<tr>
							<td>Telp</td>
							<td><input type="text" name="telp"></td>
						</tr>

						<tr>
							<td>Alamat</td>
							<td><input type="text" name="alamat"></td>
						</tr>
						<tr>
							<td></td>
							<td><input class="btn btn-success" type="submit" name="Submit" value="Add">
							<input class="btn btn-danger" type="reset" name="reset" value="Reset"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<?php

	// Check If form submitted, insert form data into users table.
	if (isset($_POST['Submit'])) {
		$id_penerbit = $_POST['id_penerbit'];
		$nama_penerbit = $_POST['nama_penerbit'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];

		include_once("koneksi.php");

		$result = mysqli_query($conn, "INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `email`, `telp`, `alamat`) VALUES ('$id_penerbit', '$nama_penerbit', '$email', '$telp', '$alamat');");

		header("Location:index.php");
	}
	?>
</body>

</html>