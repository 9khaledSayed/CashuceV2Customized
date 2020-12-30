<?php

namespace App\Rules;

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

//        $monthsCreated = Payroll::get()->map(function ($payroll) {
//            return $payroll->date->year . '-' . sprintf('%02d', $payroll->date->month);
//        });
//        return !in_array($value, $monthsCreated->toArray());
        return Payroll::where('year_month' , $value)->doesntExist();
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
