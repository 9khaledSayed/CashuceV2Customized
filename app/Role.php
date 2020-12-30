<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Role extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
    public static function booted()
    {
//        static::creating(function ($model){
//            $employee = auth()->user();
//            // Get the id of the company manager
//            $managerId = ($employee->is_manager)? $employee->id:$employee->manager->id;
//            $model->manager_id = $managerId; // for Ceo
//        });
        static::addGlobalScope(new ParentScope());
    }
    public function abilities()
    {
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }

    public function allowTo($ability)
    {
        if(is_string($ability)){
            $ability = Ability::whereName($ability)->firstOrFail();
        }
        $this->abilities()->sync($ability, false);
    }

    public function disallowTo($ability)
    {
        return $this->abilities()->detach($ability);
    }

    public function Name()
    {
        return (App::isLocale('ar'))?$this->name_arabic:$this->name_english;
    }

//    $doctor->assignAbility('sadfsdf')
/*
 * edit
 * */

}
