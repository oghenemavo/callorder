<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'supermarket_id',
        'product',
        'price',
        'quantity',
        'description',
        'expires_at',
    ];

    public function supermarket()
    {
        return $this->belongsTo(Supermarket::class);
    }
    
}
