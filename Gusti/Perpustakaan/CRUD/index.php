<?php
    include_once("koneksi.php");
    $buku = mysqli_query($mysql, "select buku.*, nama_pengarang, nama_penerbit, katalog.nama as Nama Katalog, FROM buku
                                        LEFT JOIN pengarang ON pengarang.id_pengarang = buku.id_pengarang
                                        LEFT JOIN penerbit ON penerbit.id_penerbit = buku.id_penerbit
                                        LEFT JOIN katalog ON katalog.id_katalog = buku.id_katalog
                                        ORDER BY judul ASC");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>