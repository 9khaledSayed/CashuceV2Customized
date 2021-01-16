<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name_ar', 'name_en'];

    public function getDescriptionForEvent(string $eventName): string
    {
        $baseName = class_basename(__CLASS__);
        return "$baseName has been {$eventName}";
    }

    public function saveWithoutEvents(array $options=[])
    {
        return static::withoutEvents(function() use ($options) {
            return $this->save($options);
        });
    }

    public static function booted()
    {
        static::creating(function ($model){
            $model->company_id = Company::companyID();
        });
        static::addGlobalScope(new ParentScope());
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function name()
    {
        return $this->{'name_' . app()->getLocale()};
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
