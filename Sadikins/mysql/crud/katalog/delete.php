<?php 

include_once('../config/connect.php');

 $id_katalog = $_GET['id'];


 $koneksi->query("DELETE FROM katalog WHERE id_katalog='$id_katalog'  ");

 header("Location:index.php");

 ?>