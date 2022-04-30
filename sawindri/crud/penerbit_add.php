<?php
	include_once("connect.php");
    $penerbit = mysqli_query($conn, "SELECT * FROM penerbit");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penerbit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
    <a href="penerbit.php" class="btn btn-secondary mt-3 mb-3">Back to Penerbit</a>

    <form action="penerbit_add.php" method="POST">
        <table border="0">
            <tr>
                <th>Id Penerbit</th>
                <th><input type="text" name="id_penerbit"></th>
            </tr>
            <tr>
                <th>Nama Penerbit</th>
                <th><input type="text" name="nama_penerbit"></th>
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
			$id_penerbit = $_POST['id_penerbit'];
			$nama_penerbit = $_POST['nama_penerbit'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("connect.php");

			$result = mysqli_query($conn, "INSERT INTO `penerbit`(`id_penerbit`, `nama_penerbit`, `email`, `telp`, `alamat`) VALUES ('$id_penerbit','$nama_penerbit','$email','$telp','$alamat')");
			
			header("Location:penerbit.php");
		}
    ?>
    
</body>
</html>