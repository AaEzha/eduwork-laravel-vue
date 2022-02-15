<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<title>Edit Katalog</title>
</head>

<?php
include_once("koneksi.php");
$id_katalog = $_GET['id_katalog'];


$katalog = mysqli_query($conn, "SELECT * FROM katalog WHERE id_katalog='$id_katalog'");

while ($katalog_data = mysqli_fetch_array($katalog)) {
	$id_katalog = $katalog_data['id_katalog'];
	$nama_katalog = $katalog_data['nama'];
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

				<form action="edit_katalog.php?id_katalog=<?php echo $id_katalog; ?>" method="post">
					<table width="25%" border="0">
						<tr>
							<td>Id Katalog</td>
							<td style="font-size: 11pt;"><?php echo $id_katalog; ?> </td>
						</tr>
						<tr>
							<td>Nama Katalog</td>
							<td><input type="text" name="nama" value="<?php echo $nama_katalog; ?>"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="update" value="Update"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<?php

	// Check If form submitted, insert form data into users table.
	if (isset($_POST['update'])) {

		$id_katalog = $_GET['id_katalog'];
		$nama_katalog = $_POST['nama'];

		include_once("koneksi.php");

		$result = mysqli_query($conn, "UPDATE katalog SET nama = '$nama_katalog' WHERE id_katalog = '$id_katalog';");

		header("Location:index.php");
	}
	?>
</body>

</html>