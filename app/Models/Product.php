<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['id', 'name', 'code', 'avatar1', 'avatar2', 'avatar3', 'avatar4', 'avatar5', 'avatar6',
        'avatar7', 'avatar8', 'category_id', 'category_id_2', 'category_id_3', 'warranty', 'procedure', 'detail', 'unit_price',
        'promotion_price', 'count' , 'price_applied', 'status', 'link', 'is_new'];

    public function category()
    {
        return $this->belongsTo('\App\Models\Category', 'category_id', 'id');
    }

    public function category1()
    {
        return $this->belongsTo('\App\Models\Category', 'category_id_2', 'id');
    }

    public function category2()
    {
        return $this->belongsTo('\App\Models\Category', 'category_id_3', 'id');
    }
}
