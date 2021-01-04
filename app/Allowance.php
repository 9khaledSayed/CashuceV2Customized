<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $guarded = [];
    public static $rules = [
        'name_ar'    => 'sometimes|required|string:191|unique:allowances',
        'name_en'    => 'sometimes|required|string:191|unique:allowances',
        'percentage' => [] ,
        'value' =>  [],
        'type' => 'required|integer'
    ];
    public function name()
    {
        return $this->{'name_' . app()->getLocale()};
    }
}
