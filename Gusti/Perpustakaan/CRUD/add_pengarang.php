<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<title>Add Pengarang</title>
</head>

<?php
include_once("koneksi.php");
$pengarang = mysqli_query($conn, "SELECT * FROM pengarang");
?>

<body>
	<div class="container">

		<div class="main">
			<a href="index.php">Go to Home</a>
			<br /><br />
			<div class="card">
				<div class="card-header text-white bg-secondary">
					Tambah Pengarang
				</div>
				<div class="card-body">

					<form action="add_pengarang.php" method="post" name="form1">
						<table border="0">
							<tr>
								<td>Id Pengarang</td>
								<td><input type="text" name="id_pengarang"></td>
							</tr>
							<tr>
								<td>Nama Pengarang</td>
								<td><input type="text" name="nama_pengarang"></td>
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
								<input class="btn btn-danger" type="reset" value="Reset"></td>
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
		$id_pengarang = $_POST['id_pengarang'];
		$nama_pengarang = $_POST['nama_pengarang'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];

		include_once("koneksi.php");

		$result = mysqli_query($conn, "INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `email`, `telp`, `alamat`) VALUES ('$id_pengarang', '$nama_pengarang', '$email', '$telp', '$alamat');");

		header("Location:index.php");
	}
	?>
</body>

</html>