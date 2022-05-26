<?php
$servername = "localhost";
$database = "perpus";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully";
// mysqli_close($conn);

$sql = "SELECT nama, telp, alamat, tgl_pinjam, tgl_kembali, b.isbn, qty, judul, harga_pinjam, (qty*harga_pinjam) as total_harga FROM `peminjaman` p LEFT JOIN anggota a ON p.id_anggota =a.id_anggota LEFT JOIN detail_peminjaman dp ON p.id_pinjam = dp.id_pinjam LEFT JOIN buku b ON b.isbn = dp.isbn ORDER BY qty DESC;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "
    <table border=1>
    <thead>
    <tr>
      <th>Nama</th>
      <th>Telepon</th>
      <th>Alamat</th>
      <th>Tgl Pinjam</th>
      <th>Tgl Kembali</th>
      <th>ISBN</th>
      <th>QTY</th>
      <th>Judul</th>    
      <th>Harga Pinjam</th>
      <th>Total</th>
    </tr>
    </thead>";

    while ($row = $result->fetch_assoc()) {
        echo     " <tbody>
            <tr>
            <td>" . $row["nama"] . "</td>
            <td>" . $row["telp"] . "</td>
            <td>" . $row["alamat"] . "</td>
            <td>" . $row["tgl_pinjam"] . "</td>
            <td>" . $row["tgl_kembali"] . "</td>
            <td>" . $row["isbn"] . "</td>
            <td>" . $row["qty"] . "</td>
            <td>" . $row["judul"] . "</td>
            <td>" . $row["harga_pinjam"] . "</td>
            <td>" . $row["total_harga"] . "</td>
            </tr>";
    }
    echo "</tbody>  
            </table>";
} else {
    echo "0 results";
}
$conn->close();
