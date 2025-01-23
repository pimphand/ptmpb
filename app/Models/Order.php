<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['is_folow_up', 'items', 'data', 'customer_id', 'status', 'user_id'];

    protected $casts = [
        'is_folow_up' => 'boolean',
        'data' => 'array',
        'items' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
