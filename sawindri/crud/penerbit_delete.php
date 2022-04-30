<?php 
    include_once('connect.php');
    $id_penerbit = $_GET['id_penerbit']; 
    $result = mysqli_query($conn, "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'");

    //after delete redirect to home, so that latest user list will be displayed
    header("location:penerbit.php"); 
?>