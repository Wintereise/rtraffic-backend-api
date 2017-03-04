<?php


namespace App\Http\Controllers;
use App\ExcludedRegion;
use Illuminate\Http\Request;

class excludedRegionsController extends Controller
{
    public function fetch (Request $request)
    {
        $data = ExcludedRegion::where('user_id', 1)->get();
        $ret = [];
        foreach ($data as $region)
        {
            list($lat, $long) = explode(",", $region->location);
            $ret[] = [ 'id' => $region->id, 'user_id' => $region->user_id, 'title' => $region->title, 'created_at' => $region->created_at,
                'location' => [ 'latitude' => $lat, 'longitude' => $long ]
            ];
        }
        return json_encode($ret);
    }

    public function insert (Request $request)
    {
        $model = new ExcludedRegion();
        $model->user_id = $request->user_id;
        $model->title = $request->title;
        $model->location = $request->location['latitude'] .", " . $request->location['longitude'];
        $model->save();

        return json_encode([
            'status' => 200,
            'message' => 'Record was successfully inserted.',
            'data' => [ 'id' => $model->id ]
        ]);
    }

    public function delete (Request $request, $id)
    {
        ExcludedRegion::destroy($id);
        return json_encode([
            'status' => 200,
            'message' => 'Record was successfully deleted.'
        ]);
    }
}