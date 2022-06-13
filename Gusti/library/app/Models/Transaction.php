<?php

namespace App\Models;

// use App\Models\Book;
// use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'date_start', 'date_end','status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)->wherePivotIn( 'book_id','qty');
    }
}
