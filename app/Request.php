<?php

namespace App;

use App\Notifications\NewRequest;
use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $guarded = [];
    protected $casts = [
        "created_at" => "date:Y-m-d"
    ];


    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new ParentScope());

        static::deleting(function($request){
            $request->requestable->delete();
        });
        static::creating(function ($model){
            // assign the request to its own company
            $employee = auth()->user();
            $managerId = ($employee->is_manager)? $employee->id:$employee->manager->id;
            $model->manager_id = $managerId; // for Ceo
        });
        static::created(function($request){
            $employees = Employee::get();
            foreach ($employees as $employee) {
                if($employee->roles->first()->label == 'Supervisor'){
                    $employee->notify(new NewRequest());
                }
            }
        });
    }

    public function type()
    {
        $type = '';
        switch ($this->requestable_type){
            case "App\\AttendanceForgotten":
                $type = __('Attendance Forgotten Request');
                break;
            case "App\\Vacation":
                $type = __('Vacation Request');
                break;
        }
        return $type;
    }

    public function statusClass()
    {
        $class ='';
        switch ($this->status){
            case 0:
                $class = 'kt-badge--primary';
                break;
            case 1:
                $class = 'kt-badge--success';
                break;
            case 2:
                $class = 'kt-badge--danger';
                break;
        }
        return $class;
    }

    public function statusTitle()
    {
        $title ='';
        switch ($this->status){
            case 0:
                $title = __('Pending');
                break;
            case 1:
                $title = __('Approved');
                break;
            case 2:
                $title = __('Disapproved');
                break;
        }
        return $title;
    }
    public function requestable()
    {
        return $this->morphTo();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class)->withoutGlobalScope(ParentScope::class);
    }
}
