<?php   
include_once("connect.php");
$buku = mysqli_query($conn,"select buku.*, nama_pengarang, nama_penerbit, katalog.nama as nama_katalog from buku 
left join pengarang ON pengarang.id_pengarang = buku.id_pengarang
left join penerbit ON penerbit.id_penerbit = buku.id_penerbit
left join katalog ON katalog.id_katalog = buku.id_katalog
order by judul asc");
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

<a href="add.php"> Add New Buku</s><br/><br/>

<table width = '80%' border=1>

<tr>
    <th>ISBN</th>
    <th>Judul</th>
    <th>Tahun</th>
    <th>Pengarang</th>
    <th>Penerbit</th>
    <th>Katalog</th>
    <th>Stok</th>
    <th>Harga</th>
    <th>Aksi</th>
</tr>
<?php
while($buku_data = mysqli_fetch_array($buku)) {
    echo"<tr>";
    echo"<td>". $buku_data['isbn']."</td>";
    echo"<td>". $buku_data['judul']."</td>";
    echo"<td>". $buku_data['tahun']."</td>";
    echo"<td>". $buku_data['nama_pengarang']."</td>";
    echo"<td>". $buku_data['nama_penerbit']."</td>";
    echo"<td>". $buku_data['nama_katalog']."</td>";
    echo"<td>". $buku_data['qty_stok']."</td>";
    echo"<td>". $buku_data['harga_pinjam']."</td>";
    echo"<td><a href= 'edit.php?isbn=$buku_data[isbn]'>Edit</a>|<a href= 'delete.php?isbn=$buku_data[isbn]'>Delete</a></td></tr>";
}
?>
</table>
</body>
</html> 