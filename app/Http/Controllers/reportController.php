<?php


namespace app\Http\Controllers;


use App\Location;
use App\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public function fetchReportsById ($id, $history = false)
    {

    }

    public function fetchReportsByGeom ($long, $lat, $history)
    {

    }

    public function addReportByGeom (Request $request, $long, $lat)
    {

    }

    public function editReport (Report $report, $id)
    {

    }

    public function deleteReport ($id)
    {

    }

}