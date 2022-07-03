<?php 
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan();
?>
<html>
	<head>
		<title>print</title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container-fluid">
			<p><?php echo $toko['nama_toko'];?></p>
			<p><?php echo $toko['alamat_toko'];?></p>
			<p>Tanggal : <?php  echo date("j F Y, G:i");?></p>
			<p>Kasir : <?php  echo $_GET['nm_member'];?></p>
			<table class="table table-bordered" style="width:40%;font-size:10px;">

				<tr>
					<td>No.</td>
					<td>Barang</td>
					<td>Jumlah</td>
					<td>Total</td>
				</tr>
				<?php $no=1; foreach($hsl as $isi){?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $isi['nama_barang'];?></td>
					<td><?php echo $isi['jumlah'];?></td>
					<td><?php echo $isi['total'];?></td>
				</tr>
				<?php $no++; }?>
			</table>
			<?php $hasil = $lihat -> jumlah(); ?>
			Total : Rp.<?php echo number_format($hasil['bayar']);?>,-
			<br/>
			Bayar : Rp.<?php echo number_format($_GET['bayar']);?>,-
			<br/>
			Kembali : Rp.<?php echo number_format($_GET['kembali']);?>,-
		</div>
	</body>
</html>
