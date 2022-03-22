<html>
<head>
	<title>Add Katalog</title>
</head>

<?php
	include_once("connect.php");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
?>
 
<body>
	<a href="index.php">Go to Home</a>
	<br/><br/>
 
	<form action="addKatalog.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>ID</td>
				<td><input type="text" name="id"></td>
			</tr>
			<tr> 
				<td>Nama</td>
				<td><input type="text" name="nama"></td>
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
			$id_katalog = $_POST['id_katalog'];
			$nama = $_POST['nama'];
			include_once("connect.php");

			$result = mysqli_query($mysqli, "INSERT INTO `katalog` (`id_katalog`, `nama`);");
			
			header("Location:katalog.php");
		}
	?>
</body>
</html>