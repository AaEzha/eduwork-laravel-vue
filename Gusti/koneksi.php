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

// echo "Connection Successfully";
// mysqli_close($conn);

$sql = "SELECT * FROM buku";
$result = $conn ->query($sql);

//output data of each row
if($result -> num_rows > 0) {

    while ($row = $result -> fetch_assoc()) {
        echo "Buku : ". $row ["isbn"] . " " . $row ["judul"]. "<br>";
    }
} else {
    echo "0 Result";
}
$conn->close();


?>
