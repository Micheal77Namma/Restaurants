<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\role;
class admin
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

		if(Auth::check()){
            if(role::find(Auth::user()->role_id)->name =="admin")
		{
        return $next($request);
    }
	else{

		return redirect()->route('login');
	}
	}}
}
