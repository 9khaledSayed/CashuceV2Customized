<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $guarded = [];
    public static $rules = [
        'name_ar' => ['required', 'string', 'max:25'],
        'name_en' => ['required', 'string', 'max:25'],
    ];

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
