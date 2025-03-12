<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'owner_address',
        'store_name',
        'store_photo',
        'owner_photo',
        'identity',
        'npwp',
        'others',
        'user_id',
        'is_blacklist',
        'city',
        'state',
    ];

    protected $hidden = [
        //        'is_blacklist',
        'created_at',
        'updated_at',
        'deleted_at',
        //        'user_id',
    ];

    public function scopeIsBlock($query, $bool = false)
    {
        return $query->where('is_blacklist', $bool);
    }
}
