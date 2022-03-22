<?php
include_once("connect.php");
 
$id_penerbit = $_GET['id_penerbit'];
 
$result = mysqli_query($mysqli, "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:penerbit.php");
?>