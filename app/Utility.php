<?php


namespace App;


class Utility
{
    const CONGESTED = 32001;
    const SLOW_BUT_MOVING = 32002;
    const UNCONGESTED = 32003;

    /*
     * @returns Greater circle (haversine) distance between a pair of point coordinates in meters
     */
    public static function greaterCircleDistance ($lat1, $long1, $lat2, $long2, $radius = 6371)
    {
        $distanceLat = deg2rad($lat2 - $lat1);
        $distanceLon = deg2rad($long2 - $long1);
        $a = sin($distanceLat / 2) * sin($distanceLat / 2) +
            sin($distanceLon / 2) * sin($distanceLon / 2) * cos(deg2rad($lat1)) * cos(deg2rad($lat2));
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $radius * $c * 1000;
    }

    public static function resolveSeverity (int $numericRepresentation)
    {
        switch ($numericRepresentation)
        {
            case self::CONGESTED:
                return "congested";
            case self::SLOW_BUT_MOVING:
                return "slow, but moving";
            case self::UNCONGESTED:
                return "uncongested";
        }
    }


}