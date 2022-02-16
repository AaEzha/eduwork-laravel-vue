<html>
<head>
	<title>Add katalog</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<?php
	include_once("connect.php");
    $katalog = mysqli_query($conn, "SELECT * FROM katalog");
?>
 
<body>
	<br/>
	<a class = 'btn btn-info' href="index.php">Go to Home</a>
	<br/><br/>
 
	<form action="add_katalog.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>ID_katalog</td>
				<td><input type="text" name="id_katalog"></td>
			</tr>
			<tr> 
				<td>Nama_katalog</td>
				<td><input type="text" name="nama"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" class="btn btn-primary" value="Add" ></td>
			</tr>
		</table>
	</form>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['Submit'])) {
			$id_katalog = $_POST['id_katalog'];
			$nama = $_POST['nama'];
			
			include_once("connect.php");

			$result = mysqli_query($conn, "INSERT INTO katalog (id_katalog,nama) VALUES ($id_katalog, '$nama');");
			
			header("Location:katalog.php");
		}
	?>
</body>
</html>