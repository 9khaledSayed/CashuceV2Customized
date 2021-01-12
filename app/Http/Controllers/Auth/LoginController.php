<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = RouteServiceProvider::Dashboard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:company')->except('logout');
        $this->middleware('guest:employee')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {

        $employeeAttempt = Auth::guard('employee')->attempt( // employees
            $this->credentials($request), $request->has('remember')
        );

        if(!$employeeAttempt){
            return Auth::guard('company')->attempt( // companies
                $this->credentials($request), $request->has('remember')
            );
        }
        Session::put('locale', setting('lang') ?? 'en');
        return $employeeAttempt;
    }

}
