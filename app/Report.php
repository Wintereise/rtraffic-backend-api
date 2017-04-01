<?php


namespace app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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

    public function scopeInHours ($query, $hours)
    {
        return $query->where('updated_at', '>=', Carbon::now()->subHours($hours))->get();
    }
}