<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];
    protected $casts = [
        'time_in'  => 'date:h:i',
        'time_out'  => 'date:h:i',
    ];

    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new ParentScope());

        static::creating(function ($model){
            // assign the request to its own company
            $employee = auth()->user();
            $managerId = ($employee->is_manager)? $employee->id:$employee->manager->id;
            $model->manager_id = $managerId; // for Ceo
        });
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}