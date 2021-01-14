<?php

namespace App\Rules;

use App\Employee;
use App\Payroll;
use Illuminate\Contracts\Validation\Rule;

class UniqueMonth implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(Employee::isSupervisor()){
            return Payroll::where([['year_month' , '=', $value], ['supervisor_id', '=', Employee::supervisorID()]])->doesntExist();
        }else{
            return Payroll::where('year_month' , $value, 'supervisor_id')->doesntExist();
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.uniqueMonth');
    }
}
