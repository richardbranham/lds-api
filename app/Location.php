<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    protected $table = 'locations';
    protected $primaryKey = 'location_uuid';
    public $timestamps = true;
    protected $keyType = 'uuid';
    
    protected $fillable = [
        'user_uuid',
        'latitude',
        'longitude'
    ];

    protected $dates = [
    ];

    protected $guarded = [];

    protected $casts = [
    ];
}
