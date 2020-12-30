<?php

namespace App\Scopes;

use App\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ParentScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        if (Auth::hasUser()){
            $employee = auth()->user();
            $managerId = ($employee->is_manager)? $employee->id:$employee->manager_id;
            $builder->where('manager_id', $managerId);
        }

    }
}
