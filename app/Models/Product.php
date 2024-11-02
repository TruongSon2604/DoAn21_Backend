<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'price',
        'image',
        'categories_id',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function cart(){
        return $this->hasMany(Comment::class);
    }

}
