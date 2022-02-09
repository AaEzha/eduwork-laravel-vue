<?php 

	include_once('../config/connect.php');
	
	$id_pengarang = $_GET['id'];

	$result = $koneksi->query("SELECT * FROM pengarang WHERE id_pengarang='$id_pengarang' ");


	while ($pengarang_data = $result->fetch_assoc()) {

		$id_pengarang = $pengarang_data['id_pengarang'];
		$nama_pengarang = $pengarang_data['nama_pengarang'];
		$email = $pengarang_data['email'];
		$telp = $pengarang_data['telp'];
		$alamat = $pengarang_data['alamat'];
		
	}



 ?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Edit Pengarang</title>
 </head>
 <body>

 	<a href="index.php">Go to pengarang</a>
 	<br /><br />
 	<form action="edit.php?id=<?php echo $id_pengarang; ?>" method="post">
 	    <table width="25%" border="0">
 	        <tr>
 	            <td>ID pengarang</td>
 	            <td style="font-size: 11pt;"><?php echo $id_pengarang; ?> </td>
 	        </tr>
 	        <tr>
 	            <td>Nama pengarang</td>
 	            <td><input type="text" name="nama" value="<?php echo $nama_pengarang; ?>"></td>
 	        </tr>
 	        <tr>
 	            <td>Email</td>
 	            <td><input type="email" name="email" value="<?php echo $email; ?>"></td>
 	        </tr>

 	         <tr>
 	            <td>telp</td>
 	            <td><input type="text" name="telp" value="<?php echo $telp; ?>"></td>
 	        </tr>

 	        <tr>
 	            <td>alamat</td>
 	            <td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
 	        </tr>

 	        <tr>
 	            <td></td>
 	            <td><input type="submit" name="update" value="Update"></td>
 	        </tr>
 	    </table>

 	<?php

 	// Check If form submitted, insert form data into users table.
 	if (isset($_POST['update'])) {

 	    $id_pengarang = $_GET['id'];
 	    $nama_pengarang = $_POST['nama'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];
 	   

 	    include_once("../config/connect.php");

 	    $result = $koneksi->query("UPDATE pengarang SET nama_pengarang = '$nama_pengarang', email = '$email', telp = '$telp', alamat = '$alamat'  WHERE id_pengarang = '$id_pengarang';");

 	    header("Location:index.php");
 	}
 	?>
 	
 </body>
 </html>