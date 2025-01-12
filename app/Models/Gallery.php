<?php

namespace App\Models;

use Database\Factories\GalleryFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    /** @use HasFactory<GalleryFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['title', 'description', 'url', 'is_publish','code'];

    //boot method
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->code = Str::replace('-', '', Str::slug($model->title));
        });

        static::updating(function ($model) {
            $model->code = Str::replace('-', '', Str::slug($model->title));
        });
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class, 'imaginable');
    }
}
