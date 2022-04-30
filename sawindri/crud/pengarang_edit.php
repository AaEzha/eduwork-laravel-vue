<?php
	include_once("connect.php");
	$pengarang = $_GET['id_pengarang'];

    $pengarang = mysqli_query($conn, "SELECT * FROM pengarang");

    while($pengarangData = mysqli_fetch_array($pengarang))
    {
        $id_pengarang = $pengarangData['id_pengarang'];
    	$nama_pengarang = $pengarangData['nama_pengarang'];
    	$email = $pengarangData['email'];
    	$telp = $pengarangData['telp'];
    	$alamat = $pengarangData['alamat'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengarang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
    <a href="pengarang.php" class="btn btn-secondary mt-3 mb-3">Back to pengarang</a>

    <form action="pengarang_edit.php?id_pengarang=<?= $id_pengarang?>" method="POST">
        <table border="0">
            <tr>
                <th>Id pengarang</th>
                <th><?php $id_pengarang; ?></th>
            </tr>
            <tr>
                <th>Nama pengarang</th>
                <th><input type="text" name="nama_pengarang" value="<?= $nama_pengarang; ?>"></th>
            </tr>
            <tr>
                <th>Email</th>
                <th><input type="text" name="email" value="<?= $email; ?>"></th>
            </tr>
            <tr>
                <th>Telp</th>
                <th><input type="text" name="telp" value="<?= $telp; ?>"></th>
            </tr>
            <tr>
                <th>Alamat</th>
                <th><input type="text" name="alamat" value="<?= $alamat; ?>"></th>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>

    <?php 
        if(isset($_POST['update'])) {

			$id_pengarang = $_GET['id_pengarang'];
			$nama_pengarang = $_POST['nama_pengarang'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("connect.php");

			$result = mysqli_query($conn, "UPDATE `pengarang` SET `id_pengarang`='$id_pengarang',`nama_pengarang`='$nama_pengarang',`email`='$email',`telp`='$telp',`alamat`='$alamat' WHERE id_pengarang = '$id_pengarang'");
			
			header("Location:pengarang.php");
		}
    ?>
</body>
</html>