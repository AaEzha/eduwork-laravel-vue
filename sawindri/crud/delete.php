<?php 
    include_once('connect.php');
    $isbn = $_GET['isbn']; 
    $result = mysqli_query($conn, "DELETE FROM buku WHERE isbn='$isbn'");

    //after delete redirect to home, so that latest user list will be displayed
    header("location:index.php"); 
?>