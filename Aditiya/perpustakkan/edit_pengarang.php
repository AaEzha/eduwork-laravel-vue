<html>
<head>
	<title>Edit pengarang</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<?php
	include_once("connect.php");
	$id_pengarang = $_GET['id_pengarang'];

	$pengarang = mysqli_query($conn, "SELECT * FROM pengarang WHERE id_pengarang='$id_pengarang'");
    while($pengarang_data = mysqli_fetch_array($pengarang))
    {
        $id_pengarang = $pengarang_data['id_pengarang'];
    	$nama_pengarang = $pengarang_data['nama_pengarang'];
    	$email = $pengarang_data['email'];
    	$telp = $pengarang_data['telp'];
    	$alamat = $pengarang_data['alamat'];
	}
?>
 
<body>
	<br/>
	<a class = 'btn btn-info' href="index.php">Go to Home</a>
	<br/><br/>
 
	<form action="edit_pengarang.php?id_pengarang=<?php echo $id_pengarang; ?>" method="post">
		<table width="25%" border="0">
			<tr> 
				<td>ID_pengarang</td>
				<td style="font-size: 11pt;"><?php echo $id_pengarang; ?> </td>
			</tr>
			<tr> 
				<td>Nama_pengarang</td>
				<td><input type="text" name="nama_pengarang" value="<?php echo $nama_pengarang; ?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email; ?>"></td>
			</tr>
			<tr> 
				<td>No. Telp</td>
				<td><input type="text" name="telp" value="<?php echo $telp; ?>"></td>
			</tr>
			<tr> 
				<td>Alamat</td>
				<td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="update" class="btn btn-success" value="Update"></td>
			</tr>
		</table>
	</form>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['update'])) {

			$id_pengarang = $_GET['id_pengarang'];
			$nama_pengarang = $_POST['nama_pengarang'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			include_once("connect.php");

			$result = mysqli_query($conn, "UPDATE pengarang SET id_pengarang = '$id_pengarang', nama_pengarang ='$nama_pengarang', email = '$email', telp = '$telp', alamat = '$alamat'  WHERE id_pengarang = '$id_pengarang';");
			
			header("Location:pengarang.php");
		}
	?>
</body>
</html>