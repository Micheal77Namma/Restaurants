<?php

namespace App\Http\Middleware;

use Closure;
use Hash;
use DB;
use Illuminate\Http\Request;

class apiAuth
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
        $user = DB::select("select * from users where token='". $request->bearerToken() ."'");
        if(count($user) == 0){
            return response("access denied",403);
        } else {
            return $next($request);
        }
    }
}
