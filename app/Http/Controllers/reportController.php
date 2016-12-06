<?php


namespace app\Http\Controllers;


use App\Location;
use App\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public function fetchReportsByPointId ($id, $history = false)
    {
        if(is_numeric($id))
        {
            $data = Report::where('location_id', $id)
                ->get();
            if($data)
            {
                return json_encode($data->toArray());
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

    public function fetchSingleReportById ($id)
    {
        if(is_numeric($id))
        {
            $data = Report::where('id', $id)
                ->get()
                ->first();
            if($data)
            {
                return json_encode($data->toArray());
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

    public function fetchReportsByPointGeom ($long, $lat, $history)
    {
        if($long)
        {
            $data = Report::where('location_id', 3)
                ->get()
                ->first();
            if($data)
            {
                return json_encode($data->toArray());
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

    public function insert (Request $request)
    {
        $model = new Report();
        $data = json_decode($request->body, true);
        if(isset($data['id']))
        {
            $model->location_id = $data['id'];
        }
        else if (isset($data['long']) && isset($data['lat']))
        {
            $model->location_id = 3;
        }
        $model->severity = $data['severity'];
        $model->comment = $data['comment'];
        $model->media = json_encode($data['media']);
        $model->save();
        return json_encode([
            'status' => 200,
            'message' => 'Record was successfully inserted.'
        ]);
    }

    public function updateReportById (Request $request, $id)
    {
        if(is_numeric($id))
        {
            $data = Report::where('id', $id)
                ->get()
                ->first();
            if($data)
            {
                $new = json_decode($request->body, true);
                $data->location_id = $new['id'];
                $data->severity = $new['severity'];
                $data->media = $new['media'];
                $data->save();
                return json_encode([
                    'status' => 200,
                    'message' => 'Record was successfully updated.'
                ]);
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

    public function deleteReport ($id)
    {
        if(is_numeric($id))
        {
        $data = Report::where('id', $id)
            ->get()
            ->first();
        if($data)
        {
            $data->delete();
            return json_encode([
                'status' => 200,
                'message' => 'Record was successfully deleted.'
            ]);
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