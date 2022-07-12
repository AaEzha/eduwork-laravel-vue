<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_name', 'description', 'brand', 'price', 'qty', 'product_code', 'alert_stock', 'barcode', 'qrcode', 'product_image', 'supplier'];


    public function order_detail()
    {
        return $this->hasOne(Order_Detail::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function suppliers()
    {
        return $this->hasMany(Suppliers::class);
    }
}
