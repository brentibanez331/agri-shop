<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = false;

    protected $fillable = [
        'merchant_id',
        'tag_id',
        'product_name',
        'description',
        'no_of_stocks',
        'product_rating',
        'product_img_url',
        'items_sold',
        'price',
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }
}
