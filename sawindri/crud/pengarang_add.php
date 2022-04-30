<?php
	include_once("connect.php");
    $pengarang = mysqli_query($conn, "SELECT * FROM pengarang");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengarang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
    <a href="pengarang.php" class="btn btn-secondary mt-3 mb-3">Back to Pengarang</a>
    
    <form action="pengarang_add.php" method="POST">
        <table border="0">
            <tr>
                <th>Id Pengarang</th>
                <th><input type="text" name="id_pengarang"></th>
            </tr>
            <tr>
                <th>Nama Pengarang</th>
                <th><input type="text" name="nama_pengarang"></th>
            </tr>
            <tr>
                <th>Email</th>
                <th><input type="text" name="email"></th>
            </tr>
            <tr>
                <th>Telp</th>
                <th><input type="text" name="telp"></th>
            </tr>
            <tr>
                <th>Alamat</th>
                <th><input type="text" name="alamat"></th>
            </tr>
            <tr>
                <th></th>
                <th><input type="submit" name="submit" value="Save"></th>
            </tr>
        </table>
    </form>

    <?php 
        if(isset($_POST['submit'])) {
			$id_pengarang = $_POST['id_pengarang'];
			$nama_pengarang = $_POST['nama_pengarang'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("connect.php");

			$result = mysqli_query($conn, "INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `email`, `telp`, `alamat`) VALUES ('$id_pengarang', '$nama_pengarang', '$email', '$telp', '$alamat')");
			
			header("Location:pengarang.php");
		}
    ?>
</body>
</html>