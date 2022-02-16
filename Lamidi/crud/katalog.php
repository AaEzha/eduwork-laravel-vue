<?php   
include_once("connect.php");
$katalog = mysqli_query($conn,"select * from katalog 
order by nama asc");
?>

<html>
    <head>
        <title> Homepage</title>
</head>

<body>
    <center>
        <a href="index.php"> Buku</s>|
        <a href="Penerbit.php"> Penerbit</s>|
        <a href="pengarang.php"> Pengarang</s>|
        <a href="katalog.php"> Katalog</s>|
        <hr>    
</center>

<a href="add_katalog.php"> Add New katalog</s><br/><br/>

<table width = '80%' border=1>

<tr>
    <th>ID_Katalog</th>
    <th>NAMA_Katalog</th>
    <th>Aksi</th>
</tr>
<?php
while($katalog_data = mysqli_fetch_array($katalog)) {
    echo"<tr>";
    echo"<td>". $katalog_data['id_katalog']."</td>";
    echo"<td>". $katalog_data['nama']."</td>";
    echo"<td><a href= 'edit_katalog.php?id_katalog=$katalog_data[id_katalog]'>Edit</a>|<a href= 'delete_katalog.php?id_katalog=$katalog_data[id_katalog]'>Delete</a></td></tr>";
}
?>
</table>
</body>
</html> 