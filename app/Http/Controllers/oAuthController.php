<?php


namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use Artdarek\OAuth\Facade\OAuth;
use Illuminate\Http\Request;

class oAuthController extends Controller
{
    public function endpoint (Request $request)
    {
        $provider = $request->input('provider');
        $code = $request->input('code');
        if(!is_null($code) && !is_null($provider))
        {
            $oauth = null;
            switch (strtolower($provider))
            {
                case 'facebook':
                    $oauth = OAuth::consumer('Facebook');
                    break;
                case 'google':
                    $oauth = OAuth::consumer('Google');
                    break;
                default:
                    die('Invalid request.');
            }
            $oauth->requestAccessToken($code);
        }
    }
}