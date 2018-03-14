<?php

namespace App;
use App\Traits\UuidForKey;

use Illuminate\Database\Eloquent\Model;

class TrainingContent extends Model
{
    use UuidForKey;
    
    protected $table = 'training_contents';
    protected $primaryKey = 'training_contents_uuid';
    protected $keyType = 'uuid';
    public $timestamps = true;
    protected $fillable = [
    	'training_contents_uuid',
        'file_path',
        'file_name',
        'file_type',
        'file_image_path',
        'video_length'
    ];

    protected $dates = [
    ];

    protected $guarded = [];

    protected $casts = [
    ];

    public function trainingcontent(){
        return $this->hasMany(TrainingContent::class, 'training_contents_uuid');
    }

}
