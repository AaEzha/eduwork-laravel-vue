<?php
    include_once("koneksi.php");

    $isbn = $_GET['isbn'];
    $id_penerbit = $_GET['id_penerbit'];

$result = mysqli_query($conn, "DELETE FROM buku WHERE isbn='$isbn'");
$result = mysqli_query($conn, "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php");
?>