<?php   
include_once("connect.php");
$pengarang = mysqli_query($conn,"select pengarang.*, id_pengarang, nama_pengarang, email, telp, alamat from pengarang 
order by nama_pengarang asc");
?>

<html>
    <head>
        <title> Homepage</title>
</head>

<body>
    <center>
        <a href="index.php"> Buku</s>|
        <a href="penerbit.php"> Penerbit</s>|
        <a href="pengarang.php"> Pengarang</s>|
        <a href="katalog.php"> Katalog</s>|
        <hr>    
</center>

<a href="add_pengarang.php"> Add New pengarang</s><br/><br/>

<table width = '80%' border=1>

<tr>
    <th>ID_pengarang</th>
    <th>NAMA_pengarang</th>
    <th>EMAIL</th>
    <th>TELP</th>
    <th>ALAMAT</th>
    <th>Aksi</th>
</tr>
<?php
while($pengarang_data = mysqli_fetch_array($pengarang)) {
    echo"<tr>";
    echo"<td>". $pengarang_data['id_pengarang']."</td>";
    echo"<td>". $pengarang_data['nama_pengarang']."</td>";
    echo"<td>". $pengarang_data['email']."</td>";
    echo"<td>". $pengarang_data['telp']."</td>";
    echo"<td>". $pengarang_data['alamat']."</td>";
    echo"<td><a href= 'edit_pengarang.php?id_pengarang=$pengarang_data[id_pengarang]'>Edit</a>|<a href= 'delete_pengarang.php?id_pengarang=$pengarang_data[id_pengarang]'>Delete</a></td></tr>";
}
?>
</table>
</body>
</html> 