<?php 

include_once('../config/connect.php');

 $id_pengarang = $_GET['id'];


 $koneksi->query("DELETE FROM pengarang WHERE id_pengarang='$id_pengarang'  ");

 include_once('../templates/alert.php');

 ?>