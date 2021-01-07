<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{

    protected $guarded = [];
    public static $rules = [
        'name_ar' => ['required', 'string', 'max:255'],
        'name_en' => ['required', 'string', 'max:255'],
        'work_days' => ['required', 'array'],
        'shift_start_time' => ['required'],
        'shift_end_time' => ['required'],
        'overtime_hours' => ['required'],
        'is_delay_allowed' => ['nullable', 'boolean'],
        'time_delay_allowed' => ['required_if:is_delay_allowed,true'],
        'type' => ['required', 'string', 'max:255'],
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

    public function setWorkDaysAttribute($workDays)
    {
        $this->attributes['work_days'] = serialize($workDays);
    }


    public function name()
    {
        return $this->{'name_' . app()->getLocale()};
    }

}
