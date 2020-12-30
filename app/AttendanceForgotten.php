<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceForgotten extends Model
{
    protected $guarded =[];
    protected $casts = [
        'forgotten_date' => 'date:Y-m-d'
    ];

    protected static function booted()
    {
        static::created(function($attendanceForgotten){
            Request::create([
                'employee_id' => auth()->user()->id,
                'requestable_id' => $attendanceForgotten->id,
                'requestable_type' => 'App\AttendanceForgotten',
            ]);
        });
    }

    public function request()
    {
        return $this->morphOne(Request::class, 'requestable');
    }
}
