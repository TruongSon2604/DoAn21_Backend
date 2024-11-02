<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'orders_id',
        'products_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
