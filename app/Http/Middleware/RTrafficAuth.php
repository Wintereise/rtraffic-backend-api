<?php


namespace App\Http\Middleware;
use App\User;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RTrafficAuth
{
    public function handle ($request, Closure $next)
    {
        $token = $request->header("X-RTRAFFIC-KEY");

        if (isset($request->RTRAFFIC_INTERNAL_UID) || isset($request->RTRAFFIC_INTERNAL_USER))
        {
            return response()->json([
                'status' => 422,
                'message' => 'An illegal parameter is among your input(s).'
            ], 422);
        }

        try
        {
            $user = User::where('oauth_uid', $token)->firstOrFail();
        }
        catch (ModelNotFoundException $exception)
        {
            return response()->json([
                'status' => 401,
                'message' => 'An invalid API token was specified'
            ],  401);
        }

        $request->merge([
            'RTRAFFIC_INTERNAL_UID' => $user->id,
            'RTRAFFIC_INTERNAL_USER' => $user
        ]);

        return $next($request);
    }
}