<?php

include_once('../config/connect.php');
    
$pengarang = [];

$result = $koneksi->query("SELECT * FROM pengarang");

while ($each = $result->fetch_assoc()) {
    
    $pengarang[] = $each;
}
    



 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pengarang Tambah</title>
</head>
<body>

	 <a href="index.php">Go to Pengarang</a>
    <br /><br />
    <form action="add.php" method="post">
        <table width="25%" border="0">
            <tr>
                <td>ID pengarang</td>
                <td style="font-size: 11pt;"><input type="text" name="id"></td>
            </tr>
            <tr>
                <td>Nama pengarang</td>
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

        	$result = $koneksi->query("INSERT INTO pengarang (id_pengarang, nama_pengarang, email, telp, alamat) VALUES('$id', '$nama', '$email', '$telp', '$alamat')");

        	header("Location:index.php");

        }




         ?>

	
</body>
</html>