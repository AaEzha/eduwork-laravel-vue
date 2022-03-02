<?php

namespace App\Models;

// use App\Models\Author;
// use App\Models\Catalog;
// use App\Models\Publisher;
// use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['isbn','title','year','publisher_id','author_id','catalog_id','qty','price'];
    
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
