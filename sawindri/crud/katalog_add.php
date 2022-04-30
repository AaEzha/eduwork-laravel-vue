<?php
	include_once("connect.php");
    $katalog = mysqli_query($conn, "SELECT * FROM katalog");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Katalog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
    <a href="katalog.php" class="btn btn-secondary mt-3 mb-3">Back to katalog</a>

    <form action="katalog_add.php" method="POST">
        <table border="0">
            <tr>
                <th>Id katalog</th>
                <th><input type="text" name="id_katalog"></th>
            </tr>
            <tr>
                <th>Nama katalog</th>
                <th><input type="text" name="nama"></th>
            </tr>
            <tr>
                <th></th>
                <th><input type="submit" name="submit" value="Save"></th>
            </tr>
        </table>
    </form>

    <?php 
        if(isset($_POST['submit'])) {
			$id_katalog = $_POST['id_katalog'];
			$nama = $_POST['nama'];
			
			include_once("connect.php");

			$result = mysqli_query($conn, "INSERT INTO `katalog`(`id_katalog`, `nama`) VALUES ('$id_katalog','$nama')");
			
			header("Location:katalog.php");
		}
    ?>
    
</body>
</html>