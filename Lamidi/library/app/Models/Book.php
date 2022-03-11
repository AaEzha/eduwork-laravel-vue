<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['isbn', 'title', 'year', 'publisher_id', 'author_id', 'catalog_id', 'qty', 'price'];
    public function catalog()
    {
        return $this->belongsTo('App\Models\Catalog', 'id');
    }
}
