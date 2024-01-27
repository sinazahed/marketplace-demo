<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'shipping_price',
        'user_id'
    ];

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class,'product_id');
    }
}
