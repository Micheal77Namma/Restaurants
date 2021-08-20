<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function authenticated(Request $request,$user){
        if(Auth::check() && role::find(Auth::user()->role_id)->name =="meal"){
            return redirect()->route("meal.index");
        }
        if(Auth::check() && role::find(Auth::user()->role_id)->name =="rest"){
            return redirect()->route("restaurant.index");
        }
        if(Auth::check() && role::find(Auth::user()->role_id)->name =="admin"){
            return redirect()->route("user.index");
        }


    }



    public function username(){

		return 'username';
	}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
