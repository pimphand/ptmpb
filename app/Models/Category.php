<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'description'];

    /*
     * boot
     */
    protected static function boot(): void
    {
        parent::boot();
        //        static::creating(function ($model) {
        //            $model->slug = Str::slug($model->name);
        //        });

        //        static ::updating(function ($model) {
        //            $model->slug = Str::slug($model->name);
        //        });
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }
}
