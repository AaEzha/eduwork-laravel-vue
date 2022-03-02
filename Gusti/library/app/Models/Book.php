<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    
    public function publisher()
    {
        return $this->belongsTo(Publisher::class); //,'publisher_id'
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class); //,'catalog_id'
    }

    public function author()
    {
        return $this->belongsTo(Author::class); //,'author_id'
    }

    
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
