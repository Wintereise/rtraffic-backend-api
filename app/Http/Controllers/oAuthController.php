<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class oAuthController extends Controller
{
    public function endpoint (Request $request)
    {
        $token = $request->googleSignInToken;
        $firebaseToken = $request->firebaseToken;
        $provider = $request->provider;

        $oauth_client_id = env('GOOGLE_OAUTH_WEB_CLIENT_ID');

        $client = new \Google_Client([
            'client_id' => $oauth_client_id
        ]);

        $payload = $client->verifyIdToken($token);

        if ($payload)
        {
            try
            {
                $user = User::where('email', $payload['email'])
                    ->where('oauth_provider', strtolower($provider))
                    ->firstOrFail();
            }
            catch (ModelNotFoundException $exception)
            {
                $user = new User();
                $user->name = $payload['name'];
                $user->email = $payload['email'];
                $user->oauth_provider = $provider;
            }

            $user->oauth_uid = $token;
            $user->firebase_id = $firebaseToken;
            $user->save();

            $res = json_encode([
                'status' => 200,
                'message' => 'Authentication successful!',
                'data' => [ 'token' => $user->oauth_uid ]
            ]);
        }
        else
        {
            $res = json_encode([
                'status' => 403,
                'message' => 'An invalid ID token was specified. Please re-login.',
                'data' => [ 'token' => null ]
            ]);
        }

        return $res;
    }
}