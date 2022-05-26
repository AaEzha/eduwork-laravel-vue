<?php 

include_once('../config/connect.php');

 $id_penerbit = $_GET['id'];


 $koneksi->query("DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'  ");

 include_once('../templates/alert.php');

 ?>