<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $primaryKey = 'studio_id';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price_per_hour',
    ];
}
