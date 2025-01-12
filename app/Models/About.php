<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static first()
 * @method static create(mixed $validated)
 */
class About extends Model
{
    /** @use HasFactory<\Database\Factories\AboutFactory> */
    use HasFactory, HasUuids;
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'data'];

    protected $casts = [
        'data' => 'array'
    ];
}
