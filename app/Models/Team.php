<?php

namespace App\Models;

use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static limit(int $int)
 */
class Team extends Model
{
    /** @use HasFactory<TeamFactory> */
    use HasFactory,HasUuids;

    protected $fillable = ['name', 'position', 'order', 'team_name','photo'];

}
