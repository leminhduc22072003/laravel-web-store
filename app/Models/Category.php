<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['id', 'name', 'code', 'link', 'parent_id_1', 'parent_id_2'];

    public function child1() {
        return $this->hasMany('\App\Models\Category', 'parent_id_1')->whereNull('parent_id_2');
    }

    public function child2() {
        return $this->hasMany('\App\Models\Category', 'parent_id_2');
    }

    public function parent1() {
        return $this->belongsTo('\App\Models\Category', 'parent_id_1');
    }

    public function parent2() {
        return $this->belongsTo('\App\Models\Category', 'parent_id_2');
    }

    public function product() {
        return $this->hasMany('\App\Models\Product', 'category_id_3');
    }

    public function productForCategory() {
        return $this->hasMany('\App\Models\Product', 'category_id')->whereNotNull('avatar1');
    }

    public function productForCategory1() {
        return $this->hasMany('\App\Models\Product', 'category_id_2')->whereNotNull('avatar1');
    }
}
