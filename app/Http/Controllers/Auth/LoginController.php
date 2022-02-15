<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;
    public function redirectTo(){
        switch (Auth::user()->role) {
            case 1:
                $this->redirectTo = '/home';
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo = '/unit-manager/request-form-is';
                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo = '/dc-manager/index';
                return $this->redirectTo;
                break;
            case 4:
                $this->redirectTo = '/inf-director/index';
                return $this->redirectTo;
                break;
            case 5:
                $this->redirectTo = '/dc-admin/approved-requests';
                return $this->redirectTo;
                break;
            case 6:
                $this->redirectTo = '/dc-reception/approved-requests';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
}
