<?php

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

function dateFormat($value)
{
    return date('H:i:s - d M Y', strtotime($value));
}

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}



function due_date()
{
    $transaction = Transaction::select('name', 'date_end', DB::raw('DATEDIFF(NOW(), date_end) as priode'))
        ->join('members', 'members.id', 'transactions.member_id')
        ->where('status', 0)
        ->where('date_end', '<', NOW())
        ->get();

    foreach ($transaction as $key => $value) {
        echo '
         <a class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">' . $value->name . '</p>
                    <p class="fw-light small-text mb-0"> Melewati batas waktu <span class="text-danger fw-bold">' . $value->priode . ' hari </span>  </p>
                </div>
              </a>
     ';
    }
}
