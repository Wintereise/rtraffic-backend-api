<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    protected $table = 'locations';

    public static function findByLongLat ($lat, $long, $radius, $distance_unit)
    {
        return DB::select(DB::raw('
                    SELECT z.zip,
                           z.primary_city,
                           z.center_lat, z.center_long,
                           p.distance_unit
                                    * DEGREES(ACOS(COS(RADIANS(p.latpoint))
                                    * COS(RADIANS(z.center_lat))
                                    * COS(RADIANS(p.longpoint) - RADIANS(z.center_long))
                                    + SIN(RADIANS(p.latpoint))
                                    * SIN(RADIANS(z.center_lat)))) AS distance_in_km
                     FROM locations AS z
                     JOIN (
                           SELECT  ?  AS latpoint,  ? AS longpoint,
                                   ? AS radius,      ? AS distance_unit
                       ) AS p ON 1 = 1
                     WHERE z.center_lat
                        BETWEEN p.latpoint  - (p.radius / p.distance_unit)
                            AND p.latpoint  + (p.radius / p.distance_unit)
                       AND z.center_long
                        BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
                            AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
                     ORDER BY distance_in_km
            '),[
                $lat, $long, $radius, $distance_unit
        ]);
    }
}
