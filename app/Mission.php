<?php

namespace App;
use App\Traits\UuidForKey;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use UuidForKey;
    
    protected $table = 'mission';
    protected $primaryKey = 'mission_uuid';
    protected $keyType = 'uuid';
    protected $fillable = [
        'mission_name',
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
