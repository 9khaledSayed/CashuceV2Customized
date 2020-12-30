<?php

namespace App\Rules;

use App\EmployeeViolation;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class NotRepeated implements Rule
{
    public $form_request;
    public $employeeViolation;

    /**
     * Create a new rule instance.
     *
     * @param Request $request
     * @param null $employeeViolation
     */
    public function __construct(Request $request, $employeeViolation = null)
    {
        $this->form_request = $request;
        $this->employeeViolation = $employeeViolation;
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
        $violationQuery = EmployeeViolation::where([
            ['employee_id' ,'=', $this->form_request->employee_id],
            ['date', '=', $this->form_request->date],
            ['violation_id', '=', $this->form_request->violation_id]]);
        if($this->employeeViolation)
            return $violationQuery->exists() && ($violationQuery->first() == $this->employeeViolation);
        return $violationQuery->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.exist_infraction');
    }
}
