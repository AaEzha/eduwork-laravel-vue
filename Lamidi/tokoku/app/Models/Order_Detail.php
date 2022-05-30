<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    use HasFactory;
    protected $table = 'order__details';
    protected $fillable = ['order_id', 'product_id', 'qty', 'price', 'amount', 'discount'];
}
