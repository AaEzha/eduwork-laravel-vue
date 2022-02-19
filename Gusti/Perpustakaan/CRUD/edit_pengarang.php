<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<title>Edit Pengarang</title>
</head>

<?php
include_once("koneksi.php");
$id_pengarang = $_GET['id_pengarang'];


$pengarang = mysqli_query($conn, "SELECT * FROM pengarang WHERE id_pengarang='$id_pengarang'");

while ($pengarang_data = mysqli_fetch_array($pengarang)) {
	$id_pengarang = $pengarang_data['id_pengarang'];
	$nama_pengarang = $pengarang_data['nama_pengarang'];
	$email = $pengarang_data['email'];
	$telp = $pengarang_data['telp'];
	$alamat = $pengarang_data['alamat'];
}
?>

<body>
	<div class="container-md">
		<a href="index.php">Go to Home</a>
		<br /><br />

		<div class="card">
			<div class="card-header text-white bg-secondary">
				Edit Pengarang
			</div>
			<div class="card-body">

				<form action="edit_pengarang.php?id_pengarang=<?php echo $id_pengarang; ?>" method="post">
					<table>
						<tr>
							<td>Id Pengarang</td>
							<td style="font-size: 11pt;"><?php echo $id_pengarang; ?> </td>
						</tr>
						<tr>
							<td>Nama Pengarang</td>
							<td><input type="text" name="nama_pengarang" value="<?php echo $nama_pengarang; ?>"></td>
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

		$id_pengarang = $_GET['id_pengarang'];
		$nama_pengarang = $_POST['nama_pengarang'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];

		include_once("koneksi.php");

		$result = mysqli_query($conn, "UPDATE pengarang SET nama_pengarang = '$nama_pengarang', email = '$email', telp = '$telp', alamat = '$alamat' WHERE id_pengarang = '$id_pengarang';");

		header("Location:index.php");
	}
	?>
</body>

</html>