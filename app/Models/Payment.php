<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

   
    protected $fillable = [
        'orders_id',
        'payment_method_id',
        'status_id',
        'transaction_id',
    ];
}
