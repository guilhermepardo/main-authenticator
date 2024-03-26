<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, \Closure $next)
    {
        if (!Auth::check()) {
            $statusCode = Response::HTTP_UNAUTHORIZED;
            $message = Response::$statusTexts[$statusCode];
            return response()->json(['message' => $message ], $statusCode);
        }
        return $next($request);
    }
}
