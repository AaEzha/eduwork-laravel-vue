<?php

include_once('../config/connect.php');


$isbn = $_GET['isbn'];

$result = $koneksi->query("DELETE FROM buku WHERE isbn='$isbn'");



// After delete redirect to Home, so that latest user list will be displayed.
include_once('../templates/alert.php');
