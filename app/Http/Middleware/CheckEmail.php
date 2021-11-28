<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;

class CheckEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = JWTAuth::authenticate($request->token);
        if ($user->email_verified == 0) {
            return response()->json([
                'message' => 'need email verification',
                'data' => $user
            ], Response::HTTP_OK);
        }
        return $next($request);
    }
}
