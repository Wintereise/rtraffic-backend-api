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

    public function delete (Request $request, $id)
    {
        try
        {
            $poi = PointOfInterest::findOrFail($id);
        }
        catch (ModelNotFoundException $exception)
        {
            return response()->json([
                'status' => 404,
                'message' => 'You tried to remove a resource that does not exist.'
            ], 404);
        }

        $user_id = $request->RTRAFFIC_INTERNAL_UID;

        if ($poi->user_id == $user_id)
        {
            PointOfInterest::destroy($id);
            return response()->json([
                'status' => 200,
                'message' => 'Record was successfully deleted.'
            ]);
        }
        else
            return response()->json([
                'status' => 403,
                'message' => 'You tried to remove a resource that does not belong to you.'
            ], 403);
    }
}