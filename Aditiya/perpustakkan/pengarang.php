<?php   
include_once("connect.php");
$pengarang = mysqli_query($conn,"select pengarang.*, id_pengarang, nama_pengarang, email, telp, alamat from pengarang 
order by nama_pengarang asc");
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
        <a class= "btn btn-primary" href="penerbit.php"> Penerbit</a>
        <a class= "btn btn-primary active" aria-current="page" href="pengarang.php"> Pengarang</a>
        <a class= "btn btn-primary" href="katalog.php"> Katalog</a>
        </div> 
</center>

<a class= "btn btn-warning" href="add_pengarang.php"> Add New pengarang</a>

<table class= "table" width = '80%' border=1>

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
    echo"<td><a class= 'btn btn-primary' href= 'edit_pengarang.php?id_pengarang=$pengarang_data[id_pengarang]'>Edit</a><a class= 'btn btn-danger' href= 'delete_pengarang.php?id_pengarang=$pengarang_data[id_pengarang]'>Delete</a></td></tr>";
}
?>
</table>
</body>
</html>