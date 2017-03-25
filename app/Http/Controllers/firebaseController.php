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

        $user->firebase_id = $token;
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Your firebase token has been successfully updated.'
        ]);
    }
}