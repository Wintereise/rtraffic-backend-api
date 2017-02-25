<?php


namespace app\Http\Controllers;


use App\Location;
use App\Http\Controllers\Controller;
use App\Point;
use Illuminate\Http\Request;

class pointController extends Controller
{
    public function insert (Request $request)
    {
        $json = json_decode($request->body, true);
        Point::create([
            'title' => $json['title'],
            'info' => isset($json['info']) ? $json['info'] : NULL,
            'location' => $json['lat'] . ', ' . $json['lng']
        ]);
        return json_encode([
            'status' => 200,
            'message' => 'Record was successfully inserted.'
        ]);
    }

    public function geomFetch (Request $request, $lat, $long)
    {
        if(!is_float($long + 0) && !is_float($lat + 0))
        {
            echo "Validation failed for long: $long, lat: $lat";
        }
        else
        {
            $results = Location::findByLongLat($lat, $long, 50.0, 111.045);
            var_dump($results);
        }
    }

    public function singleGeomFetch (Request $request, $long, $lat)
    {

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
                return json_encode($ret);
            }
            else
            {
                return response()->json(
                    [
                        'status' => 404,
                        'message' => 'The record you\'re looking for could not be found.'
                    ]
                );
            }
        }
        else
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'You\'ve sent a malformed HTTP request.'
                ]
            );
    }
}