<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;

class firebaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('rauth');
    }

    public function tokenUpdate (Request $request)
    {
        $token = $request->token;

        $user = $request->RTRAFFIC_INTERNAL_USER;

        if ($token != null && $token != "")
        {
            $user->firebase_id = $token;
            $user->save();
            $code = 200;
        }
        else
            $code = 400;

        return responseHandler::handle($code);
    }
}