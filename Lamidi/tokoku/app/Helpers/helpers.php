<?php

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

function format_date($value)
{
    return date('H:i:s - d M Y', strtotime($value));
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function phone($nohp)
{
    // cek apakah no hp mengandung karakter + dan 0-9
    if (!preg_match('/[^+0-9]/', trim($nohp))) {
        // cek apakah no hp karakter 1-3 adalah +62
        if (substr(trim($nohp), 0, 3) == '+62') {
            $hp = trim($nohp);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif (substr(trim($nohp), 0, 1) == '0') {
            $hp = '+62' . substr(trim($nohp), 1);
        }
    }
    return $hp;
}
function stock()
{
    $transaction = Product::select('product_name', 'qty')
        ->where('qty', '<=', '10')
        ->get();

    foreach ($transaction as $key => $value) {
        echo '
       
         <a class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark"> Product <span class="text-danger fw-bold">' . $value->product_name . ' have Low Stock</p>
                    <p class="fw-light small-text mb-0"> Qty = <span class="text-danger fw-bold">' . $value->qty . '</span>  </p>
                </div>
             
                </a>
              
     ';
    }
}
