<?php

namespace App\Models;

use Database\Factories\SkuFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    /** @use HasFactory<SkuFactory> */
    use HasFactory, HasUuids;
    protected $fillable = ['name', 'price', 'code', 'product_id', 'description', 'application', 'packaging'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class, 'imaginable');
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Image::class, 'imaginable');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->code = 'SKU' . $model->product_id . '-' . time();
        });
    }
}
