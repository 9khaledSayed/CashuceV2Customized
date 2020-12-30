<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $guarded =[];
    protected $casts = [
        'start_date'  => 'date:Y-m-d',
        'end_date'  => 'date:Y-m-d',
        'created_at'  => 'date:D M d Y',
    ];

    protected static function booted()
    {
        static::created(function($vacation){
            Request::create([
                'employee_id' => auth()->user()->id,
                'requestable_id' => $vacation->id,
                'requestable_type' => 'App\Vacation',
            ]);
        });
    }

    public function vacationType()
    {
        return $this->{'vacation_type_' . app()->getLocale()};
    }
    public function request()
    {
        return $this->morphOne(Request::class, 'requestable');
    }
}
