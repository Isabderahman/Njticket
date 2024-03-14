<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        // if(Auth::guard('sanctum')->id() == 2){
        //     return $next($request);
        // }
        if (Auth::guard('sanctum')->check()) {
            if (Auth::guard('sanctum')->user()->type_user ==1) {
                return $next($request);
            }
        }
        return response()->json(['error' => 'Unauthorized.'], 401);
    }
}
