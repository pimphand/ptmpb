<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['path', 'imaginable_id', 'imaginable_type','id'];

    public function gallery()
    {
        return $this->morphTo('imaginable', 'imaginable_type', 'imaginable_id');
    }
}
