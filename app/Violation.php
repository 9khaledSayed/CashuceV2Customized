<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Violation extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'  => 'date:D M d Y',
    ];

    public static $rules = [
        'reason_in_arabic' => 'sometimes|required|string|unique:violations',
        'reason_in_english' => 'sometimes|required|string|unique:violations',
        'panel1' => 'required|string',
        'panel2' => 'nullable|string',
        'panel3' => 'nullable|string',
        'panel4' => 'nullable|string',
        'addition_to' => 'nullable|string',
    ];

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        $baseName = class_basename(__CLASS__);
        return "$baseName has been {$eventName}";
    }

    public function reason()
    {
        return app()->isLocale('ar')? $this->reason_in_arabic : $this->reason_in_english;
    }
}
