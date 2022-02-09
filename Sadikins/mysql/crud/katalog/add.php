<?php 

include_once('../config/connect.php');
    
$katalog = [];

$result = $koneksi->query("SELECT * FROM katalog");

while ($each = $result->fetch_assoc()) {
    
    $katalog[] = $each;
}
    



 ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Tambah</title>
</head>
<body>

     <a href="index.php">Go to Katalog</a>
    <br /><br />
    <form action="add.php" method="post">
        <table width="25%" border="0">
            <tr>
                <td>ID Katalog</td>
                <td style="font-size: 11pt;"><input type="text" name="id"></td>
            </tr>
            <tr>
                <td>Nama Katalog</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="submit"></td>
            </tr>
        </table>

<?php 
    

    if(isset($_POST['submit'])) {

        $id = $_POST['id'];

        $nama = $_POST['nama'];


        $result = $koneksi->query("INSERT INTO katalog (id_katalog, nama) VALUES ('$id','$nama')");


        header("Location:index.php");




    }





 ?>

    
</body>
</html>