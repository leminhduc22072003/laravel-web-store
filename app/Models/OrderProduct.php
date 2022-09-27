<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = ['id', 'order_id', 'product_id', 'count', 'product_price'];

    public function product() {
        return $this->hasOne('\App\Models\Product', 'id', 'product_id');
    }
}
