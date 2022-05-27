<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function transaction_details(){
        return $this->hasMany('App\Models\TransactionDetail', 'transaction_id');
    }

    public function members(){
        return $this->belongsTo('App\Models\Member', 'member_id');
    }
    
}
