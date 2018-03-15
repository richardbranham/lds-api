<?php

namespace App;
use App\Traits\UuidForKey;

use Illuminate\Database\Eloquent\Model;

class TrainingProgress extends Model
{
    use UuidForKey;

    protected $table = 'training_progress';
    protected $primaryKey = 'training_progress_uuid';
    protected $keyType = 'uuid';
    public $timestamps = true;
    protected $fillable = [
        'training_contents_uuid',
        'user_uuid',
        'video_last_location'
    ];

    protected $dates = [
    ];

    protected $guarded = [];

    protected $casts = [
    ];

    protected $with = [
        'content'
    ];

    public function content() {
        return $this->belongsTo(TrainingContent::class, 'training_contents_uuid');
    }

    public function trainingcontent(){
        return $this->hasOne('App\TrainingContent', 'training_contents_uuid', 'training_contents_uuid');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_uuid');
    }
}
