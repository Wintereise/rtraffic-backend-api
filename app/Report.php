<?php


namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    protected $table = 'reports';
    protected $casts = [
        'anonymous' => 'boolean'
    ];

    public function getPolypointsAttribute ($value)
    {
        return json_decode($value);
    }
}