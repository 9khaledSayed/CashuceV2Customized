<?php

namespace App\Scopes;

use App\Company;
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
            $builder->where('company_id', Company::companyID());
        }

    }
}
