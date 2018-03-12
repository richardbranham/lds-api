<?php

namespace App;
use App\UuidForKey;

use Illuminate\Database\Eloquent\Model;

class TrainingContent extends Model
{
    use UuidForKey;
    
    protected $table = 'training_contents';
    protected $primaryKey = 'training_contents_uuid';
    protected $keyType = 'uuid';
    protected $fillable = [
    	'training_contents_uuid',
        'file_path',
        'file_name',
        'file_type',
        'video_length'
    ];

    protected $dates = [
    ];

    protected $guarded = [];

    protected $casts = [
    ];
}
