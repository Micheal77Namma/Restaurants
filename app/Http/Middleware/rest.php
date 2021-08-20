<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\role;
use  Auth;

class rest
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
        if(Auth::check() && (role::find(Auth::user()->role_id)->name =="rest" || role::find(Auth::user()->role_id)->name =="admin"))
		{
        return $next($request);
    }
	else{

		return redirect()->route('login');
	}
    }
}
