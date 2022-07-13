<?php

use App\Models\Product;
use Illuminate\Support\Facades\DB;

function format_date($value)
{
    return date('H:i:s - d M Y', strtotime($value));
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
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
                    <p class="preview-subject ellipsis font-weight-medium text-dark"> Product ' . $value->product_name . '</p>
                    <p class="fw-light small-text mb-0"> Have Qty = <span class="text-danger fw-bold">' . $value->qty . '</span>  </p>
                </div>
              </a>
     ';
    }
}
