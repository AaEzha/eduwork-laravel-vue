<?php 

$serverName = "localhost";
$database = "perpus";
$username = "root";
$password = "";

//create connection
$conn = mysqli_connect($serverName, $username, $password,  $database);

// //check connection 
// if(!$conn){
//     die("connection failed: " . mysqli_connect_error());
// }

// // echo "Connected successfuly";
// // mysqli_close($conn);

// $sql = "SELECT * FROM buku";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     //output data of each row
//     while($row = $result->fetch_assoc()){
//         echo "Buku: " . $row["isbn"] . "" . $row["judul"] . "<br>";
//     } 
// }else{
//     echo "0 result";
// }

// $conn->close();

?>