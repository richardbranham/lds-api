<?php

namespace App;
use App\UuidForKey;

use Illuminate\Database\Eloquent\Model;

class TrainingProgress extends Model
{
    use UuidForKey;

    protected $table = 'training_progress';
    protected $primaryKey = 'training_progress_uuid';
    protected $keyType = 'uuid';
    protected $fillable = [
    	'training_progress_uuid',
        'training_contents_uuid',
        'user_uuid',
        'video_last_location'
    ];

    protected $dates = [
    ];

    protected $guarded = [];

    protected $casts = [
    ];

    public function trainingcontent()
    {
        return $this->hasOne('App\TrainingContent', 'training_contents_uuid', 'training_contents_uuid');
    }
}
