<html>
<head>
	<title>Add Pengarang</title>
</head>

<?php
	include_once("connect.php");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
  
?>
 
<body>
	<a href="index.php">Go to Home</a>
	<br/><br/>
 
	<form action="add.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>ID</td>
				<td><input type="text" name="id"></td>
			</tr>
			<tr> 
				<td>Nama Pengarang</td>
				<td><input type="text" name="nama"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr> 
				<td>Telepon</td>
				<td><input type="number" name="telp"></td>
			</tr>
			<tr> 
				<td>Alamat</td>
				<td><input type="number" name="telp"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['Submit'])) {
			$id_pengarang = $_POST['id_pengarang'];
			$nama_pengarang = $_POST['nama_pengarang'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("connect.php");

			$result = mysqli_query($mysqli, "INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `email`, `telp`, `alamat`);");
			
			header("Location:pengarang.php");
		}
	?>
</body>
</html>