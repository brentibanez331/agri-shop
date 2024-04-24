<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchants extends Model
{
    use HasFactory;

    protected $table = 'merchants';

    protected $fillable = [
        'user_id',
        'store_name',
        'no_of_products',
        'pickup_address',
        'reg_address',
        'merchant_rating',
        'image_url',
        'country',
        'city',
        'state',
        'postal_code',
        'tin',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'merchant_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'merchant_id');
    }
}
