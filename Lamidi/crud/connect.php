<?php   
$servername ="localhost";
$database ="perpus";
$username ="root";
$password="";

// create connection
$conn = mysqli_connect($servername,$username,$password,$database);

//check connection
if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
}
?>