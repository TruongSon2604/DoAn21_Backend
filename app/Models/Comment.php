<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    // {Schema::create('comments', function (Blueprint $table) {
    //     $table->increments('id');
    //     $table->unsignedInteger('user_id');
    //     $table->unsignedInteger('product_id');
    //     $table->text('content');
    //     $table->integer('rating')->nullable();
    //     $table->timestamps();
    // });
    protected $fillable=['user_id','product_id','content','rating'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
