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
    protected $fillable = ['name', 'price', 'code', 'product_id','description','application','packaging','performance','stock','is_publish','weight','width','height','depth'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->code = 'SKU'.'-'.rand(1000, 9999).'-'.rand(1000, 9999);
        });
    }
}
