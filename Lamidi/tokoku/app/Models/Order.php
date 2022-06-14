<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['name', 'address'];

<<<<<<< HEAD
=======
    /**
     * Get all of the order_details for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
>>>>>>> 3a72a87cd2740565d26f5c4abf502dd7c4c83f81
    public function order_details()
    {
        return $this->hasMany(Order_Detail::class);
    }

<<<<<<< HEAD
=======
    /**
     * Get the transaction associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
>>>>>>> 3a72a87cd2740565d26f5c4abf502dd7c4c83f81
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
