<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ratings extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'review_text',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
