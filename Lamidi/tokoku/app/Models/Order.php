<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['name', 'address'];

    public function order_detail()
    {
        return $this->hasMany(Order_Detail::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
