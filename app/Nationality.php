<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $guarded = [];
    public static $rules = [
        'name_ar' => 'required|string|max:255|unique:nationalities',
        'name_en' => 'required|string|max:255|unique:nationalities',
    ];


    public function name()
    {
        return $this->{'name_' . app()->getLocale()};
    }
}
