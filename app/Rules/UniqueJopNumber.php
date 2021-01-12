<?php

namespace App\Rules;

use App\Company;
use App\Employee;
use Illuminate\Contracts\Validation\Rule;

class UniqueJopNumber implements Rule
{

    protected $id;

    /**
     * Create a new rule instance.
     *
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
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
        if(isset($this->id)) return true;

        return Employee::where([['job_number','=', $value], ['company_id', '=', Company::companyID()]])->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.unique_jop_number');
    }
}
