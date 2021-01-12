<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class VacationType extends Model
{
    protected $guarded = [];
    public static $rules = [
        'name_ar' => ['required', 'string', 'max:25'],
        'name_en' => ['required', 'string', 'max:25'],
    ];

    public static function booted()
    {
        static::addGlobalScope(new ParentScope());
        static::creating(function ($model){
            $model->company_id = Company::companyID();
        });
    }

    public function name()
    {
        return $this->{'name_' . app()->getLocale()};
    }
}
