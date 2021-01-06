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
        static::creating(static function ($model){
            $employee = auth()->user();
            $manager_id = $employee->is_manager? $employee->id:$employee->manager->id;
            $model->manager_id = $manager_id; // Ceo Id
        });
        static::addGlobalScope(new ParentScope());
    }

    public function name()
    {
        return $this->{'name_' . app()->getLocale()};
    }
}
