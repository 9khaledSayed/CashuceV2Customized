<?php

namespace App\Scopes;

use App\Company;
use App\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ServiceStatusScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('service_status', 1);

    }
}
