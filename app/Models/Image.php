<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['path', 'imaginable_id', 'imaginable_type', 'gallery_type'];

    public function gallery()
    {
        return $this->morphTo();
    }

    public function scopeIsGallery($query)
    {
        return $query->whereHas('gallery', function ($query) {
            $query->where('type', 'gallery');
        });
    }
}
