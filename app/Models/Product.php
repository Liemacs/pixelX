<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'stock',
        'brand_id',
        'cat_id',
        'child_cat_id',
        'vendor_id',
        'photo',
        'price',
        'offer_price',
        'discount',
        'release',
        'multiplayer',
        'system',
        'CPU',
        'memory',
        'graph',
        'size',
        'photo_bg',
        'status'
    ];

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public function rel_prods(){
        return $this->hasMany('App\Models\Product', 'cat_id', 'cat_id')->where('status','active')->limit(6);
    }

    public static function getProductByCart($id)
    {
        return self::where('id', $id)->get()->toArray();
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'product_orders')->withPivot('quantity');

    }

}
