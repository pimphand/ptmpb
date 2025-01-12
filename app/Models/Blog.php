<?php

namespace App\Models;

use Database\Factories\BlogFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static whereAny(string[] $array, mixed $request)
 * @method static create(mixed $validated)
 */
class Blog extends Model
{
    /** @use HasFactory<BlogFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['title', 'content', 'slug', 'user_id','is_publish','category_id','thumbnail','count'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });

        static ::updating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }
}
