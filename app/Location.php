<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'location_uuid';
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude'
    ];

    protected $dates = [
    ];

    protected $guarded = [];

    protected $casts = [
    ];
}
