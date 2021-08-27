<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'supermarket_id',
        'product',
        'quantity',
        'price',
    ];

    public function supermarket()
    {
        return $this->belongsTo(Supermarket::class, 'supermarket_id');
    }
}
