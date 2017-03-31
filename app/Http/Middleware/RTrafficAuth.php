<?php


namespace App\Http\Middleware;
use App\Http\Controllers\responseHandler;
use App\User;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RTrafficAuth
{
    public function handle ($request, Closure $next)
    {
        $token = $request->header("X-RTRAFFIC-KEY");

        if (isset($request->RTRAFFIC_INTERNAL_UID) || isset($request->RTRAFFIC_INTERNAL_USER))
            return responseHandler::handle(422);
        try
        {
            $user = User::where('oauth_uid', $token)->firstOrFail();
        }
        catch (ModelNotFoundException $exception)
        {
            return responseHandler::handle(401);
        }

        $request->merge([
            'RTRAFFIC_INTERNAL_UID' => $user->id,
            'RTRAFFIC_INTERNAL_USER' => $user
        ]);

        return $next($request);
    }
}