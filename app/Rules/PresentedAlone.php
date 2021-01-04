<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PresentedAlone implements Rule
{
    public $anotherField;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($anotherField)
    {
        $this->anotherField = $anotherField;
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

        return $value == null || $this->anotherField == null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.present_alone');
    }
}
