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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <center>
    <div class="btn-group">
        <a class= "btn btn-primary active" aria-current="page" href="index.php"> Buku</a>
        <a class= "btn btn-primary" href="penerbit.php"> Penerbit</a>
        <a class= "btn btn-primary" href="pengarang.php"> Pengarang</a>
        <a class= "btn btn-primary" href="katalog.php"> Katalog</a>
        </div>    
</center>

<a class= "btn btn-secondary" href="add.php"> Add New Buku</a>

<table class="table" width = '80%' border=1>
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
    echo"<td><a class= 'btn btn-primary' href= 'edit.php?isbn=$buku_data[isbn]'>Edit</a><a class= 'btn btn-danger' href= 'delete.php?isbn=$buku_data[isbn]'>Delete</a></td></tr>";
}
?>
</table>
</body>
</html>