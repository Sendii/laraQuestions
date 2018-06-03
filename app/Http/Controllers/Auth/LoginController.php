<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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

    protected function authenticated()
    {
     $name = Auth::user()->name;
     // $first_akses  = strtok($akses, ' ');
     // $second_akses = strtok('');

        if ( Auth::user()->name== $name) {// do your margic here
            return redirect('account/'.$name);
        }elseif(Auth::user()->akses == "Admin") {
            return redirect('admins');
        }else {
            return redirect('pagenotfound');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

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
