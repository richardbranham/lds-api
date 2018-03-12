<?php

namespace App;
use App\UuidForKey;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, Notifiable;
    use UuidForKey;

    protected $connection = 'missionapp';
    protected $primaryKey = 'user_uuid';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'username', 
        'firstname',
        'lastname',
        'mobile', 
        'avatar',
        'missionary_type',
        'access_level',
        'device'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function trainingassignments()
    {
        return $this->hasMany('App\TrainingProgress', 'users_id', 'id');
    }

    public function trainingcontent()
    {
        return $this->belongsToMany('App\TrainingContent', 'training_progress', 'users_id', 'training_contents_uuid')->withPivot('video_last_location', 'training_progress_uuid', 'updated_at');
    }
}
