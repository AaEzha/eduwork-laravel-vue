<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "carts";
    protected $fillable = ['product_id', 'product_qty', 'product_price', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
