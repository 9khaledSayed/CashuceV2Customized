<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Company extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules = [
        'name_ar' => ['required', 'string'],
        'name_en' => ['required', 'string'],
        'ceo_id'  => 'nullable|max:255|exists:employees,id',
        'hr_id'   => 'nullable|max:255|exists:employees,id',
        'county_ar' => 'nullable|string|max:255',
        'county_en' => 'nullable|string|max:255',
        'city_ar' => 'nullable|string|max:255',
        'city_en' => 'nullable|string|max:255',
        'address_ar' => 'nullable|string|max:255',
        'address_en' => 'nullable|string|max:255',
        'phone' => 'nullable|max:255',
        'postal_code' => 'nullable|max:255',
        'cr_number' => 'nullable|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg',
        'email' => 'required|string|email|max:255|unique:companies',
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    public function saveWithoutEvents(array $options=[])
    {
        return static::withoutEvents(function() use ($options) {
            return $this->save($options);
        });
    }

    public static function booted()
    {
        static::creating(function ($model){
            $role = Role::where('label', 'Company')->firstOrFail();
            $model->role_id = $role->id;
        });

        static::created(function ($model){
            Role::generateDefaultRoles($model->id);
            Allowance::generateDefaultAllowances($model->id);
        });
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public static function companyID()
    {
        return auth()->guard('company')->check() ? auth()->user()->id : auth()->user()->company_id;
    }

    public function name()
    {
        return $this->{'name_' . app()->getLocale()};
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function abilities()
    {
        return $this->role->abilities->flatten()->pluck('name')->unique();
    }


    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    //
}
