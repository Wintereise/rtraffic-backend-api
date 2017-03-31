<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'oauth_uid', 'oauth_provider', 'firebase_id'
    ];

    public function pointsOfInterest ()
    {
        return $this->hasMany('App\PointOfInterest', 'user_id', 'id');
    }

}
