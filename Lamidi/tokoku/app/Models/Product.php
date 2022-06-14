<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_name', 'description', 'brand', 'price', 'qty', 'product_code', 'alert_stock', 'barcode', 'qrcode', 'product_image'];

    public function orderdetail()
    {
        return $this->hasMany(Order_Detail::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
