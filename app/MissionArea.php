<?php

namespace App;
use App\UuidForKey;

use Illuminate\Database\Eloquent\Model;

class MissionArea extends Model
{
    use UuidForKey;
    
    protected $table = 'mission_area';
    protected $primaryKey = 'mission_area_uuid';
    protected $keyType = 'uuid';
    protected $fillable = [
    	'mission_uuid',
        'area_name',
        'contact_name',
        'contact_phone',
        'contact_email'
    ];

    protected $dates = [
    ];

    protected $guarded = [];

    protected $casts = [
    ];
}
