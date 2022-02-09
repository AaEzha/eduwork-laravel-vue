<?php

include_once('../config/connect.php');
    
$penerbit = [];

$result = $koneksi->query("SELECT * FROM penerbit");

while ($each = $result->fetch_assoc()) {
    
    $penerbit[] = $each;
}
    



 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Penerbit Tambah</title>
</head>
<body>

	 <a href="index.php">Go to Penerbit</a>
    <br /><br />
    <form action="add.php" method="post">
        <table width="25%" border="0">
            <tr>
                <td>ID Penerbit</td>
                <td style="font-size: 11pt;"><input type="text" name="id"></td>
            </tr>
            <tr>
                <td>Nama Penerbit</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td><input type="text" name="telp"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="submit"></td>
            </tr>
        </table>

        <?php 


        if(isset($_POST['submit']))
        {
        	$id = $_POST['id'];
        	$nama = $_POST['nama'];
        	$email = $_POST['email'];
        	$telp = $_POST['telp'];
        	$alamat = $_POST['alamat'];

        	$result = $koneksi->query("INSERT INTO penerbit (id_penerbit, nama_penerbit, email, telp, alamat) VALUES('$id', '$nama', '$email', '$telp', '$alamat')");

        	header("Location:index.php");

        }




         ?>

	
</body>
</html>