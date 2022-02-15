<?php   
$servername ="localhost";
$database ="perpus";
$username ="root";
$password="";

// create connection
$conn = mysqli_connect($servername,$username,$password,$database);

//check connection
if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
}
//echo "connection successfully";
//mysqli_close($conn);
$sql= "SELECT anggota.nama,anggota.telp,anggota.alamat,peminjaman.tgl_pinjam,peminjaman.tgl_kembali, detail_peminjaman.isbn, detail_peminjaman.qty, buku.judul, penerbit.nama_penerbit,pengarang.nama_pengarang,katalog.nama AS nama_katalog FROM peminjaman JOIN anggota ON peminjaman.id_anggota=anggota.id_anggota JOIN detail_peminjaman ON peminjaman.id_pinjam=detail_peminjaman.id_pinjam JOIN buku ON buku.isbn=detail_peminjaman.isbn JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang JOIN katalog ON buku.id_katalog=katalog.id_katalog;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row= $result->fetch_assoc()){
        echo "RESULT : " . $row["nama"] ."".$row["telp"]."".$row["alamat"]."".$row["tgl_pinjam"]."".$row["tgl_kembali"]."".$row["isbn"]."".$row["qty"]."".$row["judul"]."".$row["nama_penerbit"]."".$row["nama_pengarang"]."".$row["nama_katalog"].""."<br>";
    }
}else{
    echo "0 result";
}
?>