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
        'merchant_rating',
        'image_url',
        'city',
    ];
}
