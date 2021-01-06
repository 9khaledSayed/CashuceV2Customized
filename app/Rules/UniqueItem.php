<?php

namespace App\Rules;

use App\Allowance;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class UniqueItem implements Rule
{
    public $id;
    public $model;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Model $model, $id)
    {
        $this->id = $id;
        $this->model = $model;
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
        if(isset($this->id)) return true; // for update method
        $employee = auth()->user();
        $managerId = $employee->is_manager ? $employee->id:$employee->manager->id;

        return $this->model->where([
            ['name_ar','=', $value],
            ['manager_id', '=', $managerId]
        ])->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.unique_item');
    }
}
