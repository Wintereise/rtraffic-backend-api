<?php


namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;

class pointController extends Controller
{

    public function __construct()
    {
        $this->middleware('rauth');
    }

    public function geomFetch (Request $request, $lat, $long)
    {
        if(!is_float($long + 0) && !is_float($lat + 0))
        {
            return response()->json([
                'status' => 400,
                'message' => 'You have sent a malformed request.'
            ], 400);
        }
        else
        {
            $location = sprintf("%s, %s", $lat, $long);
            $distance = $request->distance ? '5' : $request->distance;

            $results = Point::distance($location, $distance)->get();

            return response()->json([
                'status' => 200,
                'message' => 'Request successful!',
                'data' => $results
            ]);
        }
    }

    public function singleGeomFetch (Request $request, $long, $lat)
    {

    }

    public function fetchAll (Request $request)
    {
        $res = [];
        $data = Point::all();

        foreach($data as $point)
        {
            list($lat, $long) = explode(",", $point['location']);
            $res[] = [
                'id' => $point['id'],
                'title' => $point['title'],
                'latitude' => $lat,
                'longitude' => $long,
                'info' => $point['info']
            ];
        };

        $status = count($data) > 0 ? 200 : 404;
        return response()->json($res, $status);
    }

    public function fetch (Request $request, $id)
    {
        if(is_numeric($id))
        {
            $data = Point::where('id', $id)
                    ->get()
                    ->first();
            if($data)
            {
                $location = $data['location'];
                list($lat, $long) = explode(",", $location);
                unset($data['location']);
                $ret = $data;
                $ret['latitude'] = $lat;
                $ret['longitude'] = $long;

                return response()->json($ret);
            }
            else
            {
                return response()->json([
                        'status' => 404,
                        'message' => 'The record you\'re looking for could not be found.'
                    ], 404);
            }
        }
        else
            return response()->json([
                    'status' => 400,
                    'message' => 'You\'ve sent a malformed HTTP request.'
                ], 400);
    }
}