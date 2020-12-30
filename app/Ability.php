<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Ability extends Model
{


    protected $guarded = [];
    protected $casts = [
//        'created_at'  => 'date:Y d M',
        'created_at'  => 'date:D M d Y',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
