<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supermarket extends Model
{
    use HasFactory;

    protected $fillable = [
        'supermarket_id',
        'name',
        'address',
        'lga',
        'state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
