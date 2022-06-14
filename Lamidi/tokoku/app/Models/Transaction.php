<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = ['order_id', 'paid_amount', 'balance', 'payment_method', 'user_id', 'transac_date', 'transac_amount'];

<<<<<<< HEAD
=======
    /**
     * Get the order that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
>>>>>>> 3a72a87cd2740565d26f5c4abf502dd7c4c83f81
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
