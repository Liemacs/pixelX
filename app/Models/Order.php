<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'payment_status', 'condition', 'order_number', 'product_id', 'sub_total', 'total_amount', 'qunatity', 'coupon', 'first_name', 'last_name', 'phone', 'email'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')->withPivot('quantity');
    }
}
