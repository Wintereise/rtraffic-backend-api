<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Point extends Model
{
    protected $table = "points";
    protected $fillable = ['title', 'info', 'location', 'created_at', 'updated_at'];
    protected $geofields = array('location');

    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = DB::raw("POINT($value)");
    }

    public function getLocationAttribute($value){

        $loc =  substr($value, 6);
        $loc = preg_replace('/[ ,]+/', ',', $loc, 1);

        return substr($loc,0,-1);
    }

    public function newQuery($excludeDeleted = true)
    {
        $raw = [];
        foreach ($this->geofields as $column)
        {
            $raw[] = " ASTEXT({$column}) AS {$column} ";
        }
        $raw = implode(',', $raw);

        return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
    }

    public function scopeDistance ($query, $distance, $location)
    {
        return $query->whereRaw('ST_DISTANCE(location, POINT(' . $location . ')) < ' . $distance);
    }
}
