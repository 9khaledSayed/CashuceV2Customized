<?php

namespace App;


use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $guarded = [];
    public static $rules = [
        'name_ar'    => ['sometimes', 'required', 'string:191'],
        'name_en'    => ['sometimes', 'required', 'string:191'],
        'percentage' => [] ,
        'value' =>  [],
        'type' => 'required|integer'
    ];

    public function saveWithoutEvents(array $options=[])
    {
        return static::withoutEvents(function() use ($options) {
            return $this->save($options);
        });
    }

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

    public static function generateDefaultAllowances($managerID)
    {
        $hra = new Allowance([
            'name_en'  => 'HRA',
            'name_ar'  => 'سكن',
            'type' => 1,
            'percentage' => 25,
            'label' => 'hra',
            'is_basic' => true,
            'company_id' => $managerID
        ]);
        $gosi = new Allowance([
            'name_en'  => 'GOSI Subscription',
            'name_ar'  => 'استقطاع التأمينات الاجتماعية',
            'type' => 0,
            'percentage' => 10,
            'label' => 'gosi',
            'is_basic' => true,
            'company_id' => $managerID
        ]);

        $hra->saveWithoutEvents(['creating']);
        $gosi->saveWithoutEvents(['creating']);
    }
}
