<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacationType extends Model
{
    protected $guarded = [];

    public function name()
    {
        return $this->{'name_' . app()->getLocale()};
    }
}
