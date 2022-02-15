<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<title>Add Katalog</title>
</head>

<?php
include_once("koneksi.php");
$katalog = mysqli_query($conn, "SELECT * FROM katalog");
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
				<form action="add_katalog.php" method="post" name="form1">
					<table border="0">
						<tr>
							<td>Id Katalog</td>
							<td><input type="text" name="id_katalog"></td>
						</tr>
						<tr>
							<td>Nama Katalog</td>
							<td><input type="text" name="nama"></td>
						</tr>
						<tr>
							<td></td>
							<td><input class="btn btn-success" type="submit" name="Submit" value="Add">
								<input class="btn btn-danger" type="reset" name="Reset" value="Reset">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<?php

	// Check If form submitted, insert form data into users table.
	if (isset($_POST['Submit'])) {
		$id_katalog = $_POST['id_katalog'];
		$nama_katalog = $_POST['nama'];

		include_once("koneksi.php");

		$result = mysqli_query($conn, "INSERT INTO `katalog` (`id_katalog`, `nama`) VALUES ('$id_katalog', '$nama_katalog');");

		header("Location:index.php");
	}
	?>
</body>

</html>