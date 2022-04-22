<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "transactions";
    protected $dates = ['deleted_at'];
    protected $fillable = ['member_id', 'date_start', 'date_end', 'status'];
    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('book_id', 'qty');
    }
    public function members()
    {
        return $this->belongsTo(Member::class);
    }
}
