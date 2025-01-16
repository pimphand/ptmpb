<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['is_folow_up', 'items', 'data'];

    protected $casts = [
        'is_folow_up' => 'boolean',
        'data' => 'array',
        'items' => 'array',
    ];
}
