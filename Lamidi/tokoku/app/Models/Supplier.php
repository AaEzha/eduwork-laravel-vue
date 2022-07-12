<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = ['name', 'type', 'address', 'phone', 'email'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
