<?php 
    include_once('connect.php');
    $id_pengarang = $_GET['id_pengarang']; 
    $result = mysqli_query($conn, "DELETE FROM pengarang WHERE id_pengarang='$id_pengarang'");

    //after delete redirect to home, so that latest user list will be displayed
    header("location:pengarang.php"); 
?>