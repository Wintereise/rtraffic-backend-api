<?php


namespace app\Http\Controllers;


use App\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class locationController extends Controller
{
    public function insert (Request $request)
    {
        $model = new Location();
        $json = json_decode($request->body, true);
        $model->name = $json['name'];
        $model->from_long = $json['from_long'];
        $model->from_lat = $json['from_lat'];
        $model->to_long = $json['to_long'];
        $model->to_lat = $json['to_lat'];
        $model->save();
        return json_encode([
            'status' => 200,
            'message' => 'Record was successfully inserted.'
        ]);
    }
}