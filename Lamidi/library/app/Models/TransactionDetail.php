<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id', 'book_id', 'qty'];
    // public function books()
    // {
    //     return $this->belongsToMany(Transaction::class, 'transaction_details', 'book_id', 'transaction_id')->withPivot('qty');
    // }
}
