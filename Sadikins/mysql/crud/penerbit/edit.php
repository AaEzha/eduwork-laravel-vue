<?php 

	include_once('../config/connect.php');
	
	$id_penerbit = $_GET['id'];

	$result = $koneksi->query("SELECT * FROM penerbit WHERE id_penerbit='$id_penerbit' ");


	while ($penerbit_data = $result->fetch_assoc()) {

		$id_penerbit = $penerbit_data['id_penerbit'];
		$nama_penerbit = $penerbit_data['nama_penerbit'];
		$email = $penerbit_data['email'];
		$telp = $penerbit_data['telp'];
		$alamat = $penerbit_data['alamat'];
		
	}



 ?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Edit Penerbit</title>
 </head>
 <body>

 	<a href="index.php">Go to penerbit</a>
 	<br /><br />
 	<form action="edit.php?id=<?php echo $id_penerbit; ?>" method="post">
 	    <table width="25%" border="0">
 	        <tr>
 	            <td>ID penerbit</td>
 	            <td style="font-size: 11pt;"><?php echo $id_penerbit; ?> </td>
 	        </tr>
 	        <tr>
 	            <td>Nama penerbit</td>
 	            <td><input type="text" name="nama" value="<?php echo $nama_penerbit; ?>"></td>
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

 	    $id_penerbit = $_GET['id'];
 	    $nama_penerbit = $_POST['nama'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];
 	   

 	    include_once("../config/connect.php");

 	    $result = $koneksi->query("UPDATE penerbit SET nama_penerbit = '$nama_penerbit', email = '$email', telp = '$telp', alamat = '$alamat'  WHERE id_penerbit = '$id_penerbit';");

 	    header("Location:index.php");
 	}
 	?>
 	
 </body>
 </html>