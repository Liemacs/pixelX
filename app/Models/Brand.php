<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable=['title', 'slug', 'status'];

    public function products()
    {
        return $this->hasMany('App\Models\Product')->where('status', 'active');
    }
}
