<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comblaint extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'message'];
}
