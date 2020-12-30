<?php

namespace App\Rules;

use App\Attendance;
use Illuminate\Contracts\Validation\Rule;

class CheckAttendanceForgotten implements Rule
{
    public $employeeID;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($employeeID)
    {
        $this->employeeID = $employeeID;
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
        return Attendance::where('date', $value)->where('employee_id', $this->employeeID)->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.attendanceForgotten');
    }
}
