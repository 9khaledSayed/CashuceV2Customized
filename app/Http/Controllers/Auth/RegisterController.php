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
            /**/
            'fname_ar' => ['required', 'string'],
            'mname_ar' => ['nullable', 'string'],
            'lname_ar' => ['required', 'string'],
            'fname_en' => ['required', 'string'],
            'mname_en' => ['nullable', 'string'],
            'lname_en' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
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
            'fname_ar' => $data['fname_ar'],
            'mname_ar' => $data['mname_ar'],
            'lname_ar' => $data['lname_ar'],
            'fname_en' => $data['fname_en'],
            'mname_en' => $data['mname_en'],
            'lname_en' => $data['lname_en'],
            'email'    => $data['email'],
            'job_number' => $jobNumber,
            'is_manager' => true,
            'vacations_balance' => 30,
            'barcode' => $barcode,
            'password' => $data['password'],
            'birthdate'      => $data['birthdate'],
            'joined_date'      => '2020-08-01',
            'nationality_id'      => '1',
            'id_num'      => '54566546544',
            'contract_type'      => '1',
            'contract_start_date'      => '2020-08-01',
            'contract_period'      => '12',
            'phone'      => '0000000000',
        ]);

        $employee->assignRole("User");
        $employee->generateDefaultRoles();
        $employee->generateDefaultAllowances();
        return $employee;
    }
}
