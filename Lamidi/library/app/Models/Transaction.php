<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon

class Transaction extends Model
{
    use HasFactory;
    public function member()
    {
        return $this->hasMany('App\Models\Member', 'member_id');
    }
}
