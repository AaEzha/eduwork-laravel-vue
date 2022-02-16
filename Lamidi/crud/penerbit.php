<?php   
include_once("connect.php");
$penerbit = mysqli_query($conn,"select penerbit.*, id_penerbit, nama_penerbit, email, telp, alamat from penerbit 
order by nama_penerbit asc");
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

<a href="add_penerbit.php"> Add New Penerbit</s><br/><br/>

<table width = '80%' border=1>

<tr>
    <th>ID_PENERBIT</th>
    <th>NAMA_PENERBIT</th>
    <th>EMAIL</th>
    <th>TELP</th>
    <th>ALAMAT</th>
    <th>Aksi</th>
</tr>
<?php
while($penerbit_data = mysqli_fetch_array($penerbit)) {
    echo"<tr>";
    echo"<td>". $penerbit_data['id_penerbit']."</td>";
    echo"<td>". $penerbit_data['nama_penerbit']."</td>";
    echo"<td>". $penerbit_data['email']."</td>";
    echo"<td>". $penerbit_data['telp']."</td>";
    echo"<td>". $penerbit_data['alamat']."</td>";
    echo"<td><a href= 'edit_penerbit.php?id_penerbit=$penerbit_data[id_penerbit]'>Edit</a>|<a href= 'delete_penerbit.php?id_penerbit=$penerbit_data[id_penerbit]'>Delete</a></td></tr>";
}
?>
</table>
</body>
</html> 