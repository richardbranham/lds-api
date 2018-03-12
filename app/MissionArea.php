<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MissionArea extends Model
{
    
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
