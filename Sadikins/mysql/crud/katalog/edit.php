<?php

include_once('../config/connect.php');

$id_katalog = $_GET['id'];


$result = $koneksi->query("SELECT * FROM katalog WHERE id_katalog='$id_katalog' ");

while ($katalog_data = $result->fetch_assoc()) {

    $id_katalog = $katalog_data['id_katalog'];
    $nama = $katalog_data['nama'];
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Edit</title>
</head>
<body>

    <a href="index.php">Go to Katalog</a>
    <br /><br />
    <form action="edit.php?id=<?php echo $id_katalog; ?>" method="post">
        <table width="25%" border="0">
            <tr>
                <td>ID Katalog</td>
                <td style="font-size: 11pt;"><?php echo $id_katalog; ?> </td>
            </tr>
            <tr>
                <td>Nama Katalog</td>
                <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>

    <?php

    // Check If form submitted, insert form data into users table.
    if (isset($_POST['update'])) {

        $id_katalog = $_GET['id'];
        $nama = $_POST['nama'];
       

        include_once("../config/connect.php");

        $result = $koneksi->query("UPDATE katalog SET nama = '$nama' WHERE id_katalog = '$id_katalog';");

        header("Location:index.php");
    }
    ?>
    
</body>
</html>
