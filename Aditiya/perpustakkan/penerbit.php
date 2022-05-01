<?php   
include_once("connect.php");
$penerbit = mysqli_query($conn,"select penerbit.*, id_penerbit, nama_penerbit, email, telp, alamat from penerbit 
order by nama_penerbit asc");
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
        <a class= "btn btn-primary" href="index.php"> Buku</a>
        <a class= "btn btn-primary active" aria-current="page" href="penerbit.php"> Penerbit</a>
        <a class= "btn btn-primary" href="pengarang.php"> Pengarang</a>
        <a class= "btn btn-primary" href="katalog.php"> Katalog</a>
        </div> 
</center>

<a class= "btn btn-warning" href="add_penerbit.php"> Add New Penerbit</a>

<table class = "table" width = '80%' border=1>

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
    echo"<td><a a class= 'btn btn-primary' href= 'edit_penerbit.php?id_penerbit=$penerbit_data[id_penerbit]'>Edit</a><a class= 'btn btn-danger' href= 'delete_penerbit.php?id_penerbit=$penerbit_data[id_penerbit]'>Delete</a></td></tr>";
}
?>
</table>
</body>
</html>