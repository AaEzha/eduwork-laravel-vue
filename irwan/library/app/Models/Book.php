<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

     public function author()
    {
    	// return $this->belongsTo('App\Models\Publisher', 'publisher_id');
    	// return $this->belongsTo('App\Models\Catalog', 'catalog_id');
    	return $this->belongsTo('App\Models\Author', 'author_id');
    }
}
