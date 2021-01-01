<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Employee extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $table = 'employees';

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

//    public static $rules = [
//        'name_in_arabic' => 'required|string|max:191',
//        'name_in_english' => 'required|string|max:191',
//        'email' => 'sometimes|required|email|unique:employees',
//        'salary' => 'required|numeric',
//        'supervisor_id' => 'nullable|numeric|exists:employees,id',
//        'job_number' => ['required'],
//        'password' => ['required', 'string', 'min:8', 'confirmed']
//    ];
    public static $managerRules = [
        'fname_ar' => ['required', 'string'],
        'mname_ar' => ['nullable', 'string'],
        'lname_ar' => ['required', 'string'],
        'fname_en' => ['required', 'string'],
        'mname_en' => ['nullable', 'string'],
        'lname_en' => ['required', 'string'],
        'email' => 'sometimes|required|email|unique:employees',
        'job_number' => 'required|numeric',
        'birthdate' => ['required', 'date'],
        'joined_date' => ['required'],
        'nationality_id' => 'required|numeric',
        'id_num' => ['required_if:identity_type,0'],
        'contract_type' => ['required'],
        'contract_start_date' => ['required'],
        'contract_period' => 'nullable',
        'phone' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed']
    ];
    public static $rules = [
        'fname_ar' => ['required', 'string'],
        'mname_ar' => ['nullable', 'string'],
        'lname_ar' => ['required', 'string'],
        'fname_en' => ['required', 'string'],
        'mname_en' => ['nullable', 'string'],
        'lname_en' => ['required', 'string'],
        'email' => 'sometimes|required|email|unique:employees',
        'supervisor_id' => 'nullable|numeric|exists:employees,id',
        'birthdate' => ['required', 'date'],
        'nationality_id' => 'required|numeric',
        'marital_status' => ['nullable'],
        'gender' => ['required'],
        'identity_type' => ['required'],
        'id_num' => ['required_if:identity_type,0'],
        'id_issue_date' => ['required_if:identity_type,0'],
        'id_expire_date' => ['required_if:identity_type,0'],
        'passport_num' => ['nullable'],
        'passport_issue_date' => ['nullable'],
        'passport_expire_date' => ['nullable'],
        'issue_place' => ['nullable'],
        'job_number' =>['required'],
        'joined_date' => ['required'],
        'work_shift' => ['required'],
        'contract_type' => ['required'],
        'contract_start_date' => ['required'],
        'contract_period' => 'nullable',
        'salary' => ['required', 'numeric'],
        'phone' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],

    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'contract_start_date' => 'datetime',
        'created_at'  => 'date:D M d Y',
    ];
    public static function booted()
    {
        //TODO :: put vacations balance in settings
        //TODO :: put work hours in settings
        //TODO :: put delay period in settings
        //TODO :: put vacations types in settings
        static::addGlobalScope(new ParentScope());

        static::creating(function ($model){
             if(auth()->check()){
                 $barcode = rand(0, 99999999);
                 $barcode = str_pad($barcode, 8, "0", STR_PAD_LEFT);
                 while (Employee::pluck('job_number')->contains($barcode)){
                     $barcode = rand(0, 99999999);
                     $barcode = str_pad($barcode, 12, "0", STR_PAD_LEFT);
                 }
                 $employee = auth()->user();
                 $manager_id = ($employee->is_manager)? $employee->id:$employee->manager->id;
                 $model->manager_id = $manager_id;
                 $model->barcode = $barcode;
                 $model->vacations_balance = 30;
             }
         });
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function name()
    {
        return $this->{'fname_' . app()->getLocale()} . ' ' . $this->{'lname_' . app()->getLocale()};
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withoutGlobalScope(ParentScope::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        if(is_string($role)){
            $role = Role::where('label', $role)->firstOrFail();
        }
        return $this->roles()->sync($role, false);
    }

    public function allowances()
    {
        return $this->belongsToMany(Allowance::class);
    }


    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id')->withoutGlobalScope(ParentScope::class);
    }

    public function dailySalary()
    {
        return $this->salary / 30;
    }

    public function employee_violations()
    {
        return $this->hasMany(EmployeeViolation::class, 'employee_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'manager_id')->withoutGlobalScope(ParentScope::class);
    }

    public function supervisedEmployees()
    {
        return $this->hasMany(Employee::class, 'supervisor_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function deductions()
    {
        return $this->employee_violations->pluck('deduction')->map(function($deduction){
            return is_numeric($deduction) ? $deduction : 0;
        })->sum();
    }

    public function workDays($month)
    {
        $work_days = Attendance::where('employee_id', $this->id)->whereNotNull(['time_in', 'time_out'])->whereMonth('created_at', $month)->count();
        return $work_days;
    }
    public function salary()
    {
        $add = 0;
        $deduc = 0;
        foreach ($this->allowances as $allowance) {
            if($allowance->type == 1){
                if(isset($allowance->percentage)){
                    $add += $this->salary * ($allowance->percentage/100);
                }else{
                    $add += $allowance->value;
                }
            }
            if($allowance->type == 0){
                if(isset($allowance->percentage)){
                    $deduc += $this->salary * ($allowance->percentage/100);
                }else{
                    $deduc += $allowance->value;
                }
            }
        }
        return $this->salary + $add - $deduc;
    }
    public function generateDefaultRoles()
    {
        $categories = [
            'roles',
            'users',
            'violations',
            'employees',
            'employees_violations',
            'reports',
            'conversations',
        ];
        $abilities = \App\Ability::get();
        if ($this->id == 1){
            $superAdmin = \App\Role::create([
                'name_english'  => 'Super Admin',
                'name_arabic'  => 'المدير التنفيذي',
                'label' => 'Super Admin',
                'type' => 'System Role',
                'manager_id' => $this->id
            ]);
            $user = \App\Role::create([
                'name_english'  => 'User',
                'name_arabic'  => 'عميل',
                'label' => 'User',
                'type' => 'System Role',
                'manager_id' => $this->id
            ]);

            foreach($abilities as $ability){
                $superAdmin->allowTo($ability);
            }

            foreach($abilities->whereIn('category',['employees', 'employees_violations', 'reports', 'conversations']) as $ability){
                $user->allowTo($ability);
            }
        }
        $Hr = \App\Role::create([
            'name_english'  => 'HR',
            'name_arabic'  => 'مدير الموارد البشرية',
            'label' => 'HR',
            'type' => 'System Role',
            'manager_id' => $this->id
        ]);
        $supervisor = \App\Role::create([
            'name_english'  => 'Supervisor',
            'name_arabic'  => 'المدير المباشر',
            'label' => 'Supervisor',
            'type' => 'System Role',
            'manager_id' => $this->id
        ]);
        $employee = \App\Role::create([
            'name_english'  => 'Employee',
            'name_arabic'  => 'موظف',
            'label' => 'Employee',
            'type' => 'System Role',
            'manager_id' => $this->id
        ]);


        foreach($abilities->whereIn('category',['employees', 'employees_violations', 'reports', 'conversations']) as $ability){
            $Hr->allowTo($ability);
        }

        foreach($abilities->whereIn('category',['reports']) as $ability){
            $supervisor->allowTo($ability);
        }

        foreach($abilities->whereIn('category',['conversations']) as $ability){
            $employee->allowTo($ability);
        }
    }


}
