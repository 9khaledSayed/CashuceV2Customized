<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
    public static $rules = [
        'employee_id' => 'required|numeric|exists:employees,id',
        'violation_date' => 'required|date',
        'description' => ['required', 'string'],
    ];

    public static function booted()
    {
        static::creating(function ($model){
            $employee = auth()->user();
            // Get the id of the company manager
            $managerId = ($employee->is_manager)? $employee->id:$employee->manager->id;
            $model->manager_id = $managerId; // for Ceo
            $model->supervisor_id = auth()->user()->id; // for director
        });
        static::addGlobalScope(new ParentScope());
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisor_id')->withoutGlobalScope(ParentScope::class);
    }
}
