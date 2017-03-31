<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class PointOfInterest extends Model
{
    protected $table = "poi";

    public function user ()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function scopePoint ($query, $pointId)
    {
        return $query->where('point_id', $pointId);
    }
}