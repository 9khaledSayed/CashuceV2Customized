<?php

namespace App\Http\Controllers\Auth;

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
            'name_in_arabic' => ['required', 'string', 'max:255'],
            'name_in_english' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
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
         $jobNumber = rand(1000,9999);
         while (Employee::pluck('job_number')->contains($jobNumber)){
             $jobNumber = rand(1000,9999);
         }
        $barcode = rand(0, 99999999);
        $barcode = str_pad($barcode, 8, "0", STR_PAD_LEFT);
        while (Employee::pluck('job_number')->contains($barcode)){
            $barcode = rand(0, 99999999);
            $barcode = str_pad($barcode, 12, "0", STR_PAD_LEFT);
        }
        $employee = Employee::create([
            'name_in_arabic' => $data['name_in_arabic'],
            'name_in_english' => $data['name_in_english'],
            'email' => $data['email'],
            'job_number' => $jobNumber,
            'is_manager' => true,
            'vacations_balance' => 30,
            'barcode' => $barcode,
            'password' => $data['password'],
        ]);
        $employee->assignRole("User");
        $employee->generateDefaultRoles();
        return $employee;
    }
}
