<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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
        'selling_price',
        'payment_method',
        'est_arrival'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchants::class, 'merchant_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
