<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    protected $fillable = [
        'product_id',
        'merchant_id',
        'user_id',
        'order_ref',
        'quantity',
        'total_amount',
        'date',
        'status',
        'payment_method',
    ];
}
