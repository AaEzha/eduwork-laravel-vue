<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->hasOne('App\Models\User', 'member_id');
    }
    public function transaction(){
        return $this->hasOne('App\Models\Transaction', 'member_id');
    }
}
