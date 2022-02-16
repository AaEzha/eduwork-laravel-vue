<?php   
include_once("connect.php");
$katalog = mysqli_query($conn,"select * from katalog 
order by nama asc");
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
        <a class= "btn btn-primary" href="pengarang.php"> Pengarang</a>
        <a class= "btn btn-primary active" aria-current="page" href="katalog.php"> Katalog</a>
        </div>    
</center>

<a class= "btn btn-secondary" href="add_katalog.php"> Add New katalog</a>

<table class= "table" width = '80%' border=1>

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
    echo"<td><a class= 'btn btn-primary' href= 'edit_katalog.php?id_katalog=$katalog_data[id_katalog]'>Edit</a><a class= 'btn btn-danger' href= 'delete_katalog.php?id_katalog=$katalog_data[id_katalog]'>Delete</a></td></tr>";
}
?>
</table>
</body>
</html> 