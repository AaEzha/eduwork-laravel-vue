<?php
$host = "localhost";
$database = "perpustakaan";
$username = "root";
$password = "";

//membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password , $database);

//check koneksi
if(!$conn) {
    die ( "connection failed: " . mysqli_connect_error());
}

echo "Connection Successfully";
mysqli_close($conn);

?>
