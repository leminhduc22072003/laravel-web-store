<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['id', 'customer_id', 'user_id', 'price'];

    public function orderProduct() {
        return $this->hasMany('\App\Models\OrderProduct', 'order_id');
    }

    public function customer() {
        return $this->belongsTo('\App\Models\Customer', 'customer_id',);
    }
}
