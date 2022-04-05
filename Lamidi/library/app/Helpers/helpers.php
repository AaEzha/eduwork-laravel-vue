<?php
function format_date($value)
{
    return date('H:i:s - d M Y', strtotime($value));
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
