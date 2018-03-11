<?php

namespace App;

use App\UuidForKey;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use UuidForKey;

    protected $table = 'locations';
    protected $primaryKey = 'location_uuid';
    public $timestamps = true;
    
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
