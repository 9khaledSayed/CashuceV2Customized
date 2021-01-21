<?php

namespace App\Rules;

use App\Employee;
use App\Payroll;
use Illuminate\Contracts\Validation\Rule;

class UniqueMonth implements Rule
{
    public $providerID;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($providerID)
    {
        $this->providerID = $providerID;
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
        return Payroll::where([['year_month' , '=', $value], ['provider_id', '=', $this->providerID]])->doesntExist();

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
