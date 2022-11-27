<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function transaction_detail(){
        return $this->hasOne(TransactionDetail::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }
    public function book(){
        return $this->hasMany(Book::class);
    }
    
}
