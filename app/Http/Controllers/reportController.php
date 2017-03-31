<?php


namespace App\Http\Controllers;


use App\Location;
use App\Report;
use App\Task;
use Illuminate\Http\Request;

class reportController extends Controller
{
    const CONGESTED = 32001;
    const SLOW_BUT_MOVING = 32002;
    const UNCONGESTED = 32003;

    public function __construct()
    {
        $this->middleware('rauth');
    }

    public function fetchReportsByPointId($id, $history = false)
    {

    }

    public function fetchSingleReportById($id)
    {
        if (is_numeric($id))
        {
            $data = Report::where('id', $id)
                ->get()
                ->first();
            if ($data)
                return response()->json($data);
            else
                return responseHandler::handle(404);
        }
        else
            return responseHandler::handle(400);
    }

    public function fetchReportsByPointGeom($long, $lat, $history)
    {
    }

    public function insert(Request $request)
    {
        $user = $request->RTRAFFIC_INTERNAL_USER;

        $model = new Report();
        $model->anonymous = $request->anonymous;
        $model->user_id = $user->id;
        $model->comment = $request->comment;
        $model->severity = $request->severity;
        $model->polypoints = json_encode($request->polypoints);
        $model->save();

        $task = new Task();
        $task->type = 'notify';
        $task->resource_id = $model->id;

        $task->save();

        return responseHandler::handle(200);
    }

    public function fetchAll(Request $request)
    {
        $data = Report::InHours($request->has('history') ? $request->history : 1);
        $status = count($data) > 0 ? 200 : 404;

        return response()->json($data, $status);
    }

    public function updateReportById(Request $request, $id)
    {
        if (is_numeric($id))
        {
            $data = Report::where('id', $id)
                ->get()
                ->first();
            if ($data)
            {
                $new = json_decode($request->body, true);
                $data->location_id = $new['id'];
                $data->severity = $new['severity'];
                $data->media = $new['media'];
                $data->save();

                return responseHandler::handle(200);
            }
            else
                return responseHandler::handle(404);
        }
        else
            return responseHandler::handle(400);
    }

    public function deleteReport($id)
    {
        if (is_numeric($id))
        {
            $data = Report::where('id', $id)
                ->get()
                ->first();
            if ($data)
            {
                $data->delete();
                return responseHandler::handle(200);
            }
            else
                return responseHandler::handle(404);
        }
        else
            return responseHandler::handle(400);
    }

}