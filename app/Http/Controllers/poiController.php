<?php


namespace App\Http\Controllers;

use App\PointOfInterest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class poiController extends Controller
{
    public function __construct()
    {
        $this->middleware('rauth');
    }

    public function fetch (Request $request)
    {
        $user_id = $request->RTRAFFIC_INTERNAL_UID;

        $data = PointOfInterest::where('user_id', $user_id)->get();
        return response()->json($data);
    }

    public function insert (Request $request)
    {
        $user_id = $request->RTRAFFIC_INTERNAL_UID;

        $model = new PointOfInterest();
        $model->user_id = $user_id;
        $model->point_id = $request->point_id;
        $model->save();

        return json_encode([
            'status' => 200,
            'message' => 'Record was successfully inserted.',
            'data' => [ 'id' => $model->id ]
        ]);
    }

    public function delete (Request $request, $point_id)
    {
        $user_id = $request->RTRAFFIC_INTERNAL_UID;

        try
        {
            $poi = PointOfInterest::where('point_id', $point_id)
                ->where('user_id', $user_id)
                ->firstOrFail();
        }
        catch (ModelNotFoundException $exception)
        {
            return responseHandler::handle(404);
        }

        if ($poi->user_id == $user_id)
        {
            $poi->delete();
            return responseHandler::handle(200);
        }
        else
            return responseHandler::handle(403);
    }
}