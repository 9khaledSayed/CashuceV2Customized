<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_ar' => ['required', 'string', 'max:191'],
            'name_en' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Employee
     */
    protected function create(array $data)
    {
        return Company::create([
            'name_ar'     => $data['name_ar'],
            'name_en'     => $data['name_en'],
            'email'    => $data['email'],
            'password' => $data['password']
        ]);
    }
}
