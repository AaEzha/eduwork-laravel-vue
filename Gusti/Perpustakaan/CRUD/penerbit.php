<?php
    include_once("koneksi.php");
    $penerbit = mysqli_query($conn,"SELECT penerbit. *, nama_penerbit, penerbit.email, penerbit.telp, penerbit.alamat FROM penerbit
                                        ORDER BY nama_penerbit ASC");


?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Penerbit</title>
</head>
<body >
    <div class="container-md">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Buku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="penerbit.php">Penerbit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pengarang.php">Pengarang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="katalog.php">Katalog</a>
            </li>
        </ul>
        <a class = 'btn btn-warning' href="Add_penerbit.php">Add New Penerbit</a><br/><br/>
        
        
        <table class="table border border-dark table-bordered" >
            
            <tr class="table-dark">
                <th>ID Penerbit</th>
                <th>Nama Penerbit</th>
                <th>Email</th>
                <th>Tlp</th>
                <th>Alamat</th>
                <th>Aksi</th>
                
            </tr>

            <?php
                while($penerbit_data = mysqli_fetch_array($penerbit)) {         
                    echo "<tr>";
                    echo "<td>".$penerbit_data['id_penerbit']."</td>";
                    echo "<td>".$penerbit_data['nama_penerbit']."</td>";
                    echo "<td>".$penerbit_data['email']."</td>";    
                    echo "<td>".$penerbit_data['telp']."</td>";    
                    echo "<td>".$penerbit_data['alamat']."</td>";    
                    echo "<td><a class='btn btn-primary' href='edit_penerbit.php?id_penerbit=$penerbit_data[id_penerbit]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_penerbit=$penerbit_data[id_penerbit]'>Delete</a></td></tr>";        
                }
            ?>
        </table>
    </div>
</body>
</html>