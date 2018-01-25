<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingProgress extends Model
{
    protected $table = 'training_progress';
    protected $primaryKey = 'training_progress_uuid';
    protected $fillable = [
    	'training_progress_uuid',
        'training_contents_uuid',
        'users_id',
        'video_last_location'
    ];

    protected $dates = [
    ];

    protected $guarded = [];

    protected $casts = [
    ];

}
