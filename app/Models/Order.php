<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'customer_name',
        'customer_email',
        'phone_number',
        'total',
        'items',
        'is_confirmed',
        'is_delivered',
    ];
    
}
