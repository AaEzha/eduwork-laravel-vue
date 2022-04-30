<?php
	include_once("connect.php");
	$katalog = $_GET['id_katalog'];

    $katalog = mysqli_query($conn, "SELECT * FROM katalog");

    while($katalogData = mysqli_fetch_array($katalog))
    {
        $id_katalog = $katalogData['id_katalog'];
    	$nama = $katalogData['nama'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit katalog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
    <a href="katalog.php" class="btn btn-secondary mt-3 mb-3">Back to katalog</a>

    <form action="katalog_edit.php?id_katalog=<?= $id_katalog?>" method="POST">
        <table border="0">
            <tr>
                <th>Id Katalog</th>
                <th><?php $id_katalog; ?></th>
            </tr>
            <tr>
                <th>Nama Katalog</th>
                <th><input type="text" name="nama" value="<?= $nama; ?>"></th>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>

    <?php 
        if(isset($_POST['update'])) {

			$id_katalog = $_GET['id_katalog'];
			$nama = $_POST['nama'];
			
			include_once("connect.php");

			$result = mysqli_query($conn, "UPDATE `katalog` SET `id_katalog`='$id_katalog',`nama`='$nama' WHERE id_katalog = '$id_katalog'");
			
			header("Location:katalog.php");
		}
    ?>
</body>
</html>