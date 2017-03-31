<?php


namespace App\Http\Controllers;
use App\ExcludedRegion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class excludedRegionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('rauth');
    }

    public function fetch (Request $request)
    {
        $user = $request->RTRAFFIC_INTERNAL_USER;

        $data = ExcludedRegion::where('user_id', $user->id)->get();
        $ret = [];
        foreach ($data as $region)
        {
            list($lat, $long) = explode(",", $region->location);
            $ret[] = [ 'id' => $region->id, 'user_id' => $region->user_id, 'title' => $region->title, 'created_at' => $region->created_at,
                'location' => [ 'latitude' => trim($lat), 'longitude' => trim($long) ]
            ];
        }

        $status = count($data) > 0 ? 200 : 404;

        return response()->json($ret, $status);
    }

    public function insert (Request $request)
    {
        $user = $request->RTRAFFIC_INTERNAL_USER;

        $model = new ExcludedRegion();
        $model->user_id = $user->id;
        $model->title = $request->title;
        $model->location = $request->location['latitude'] .", " . $request->location['longitude'];
        $model->save();

        return responseHandler::handle(200, [ 'id' => $model->id ]);
    }

    public function delete (Request $request, $id)
    {
        try
        {
            $er = ExcludedRegion::findOrFail($id);
        }
        catch (ModelNotFoundException $exception)
        {
            return responseHandler::handle(404);
        }

        $user = $request->RTRAFFIC_INTERNAL_USER;

        if ($er->user_id == $user->id)
        {
            ExcludedRegion::destroy($id);
            $status = 200;
        }
        else
            $status = 403;

        return responseHandler::handle($status);
    }
}