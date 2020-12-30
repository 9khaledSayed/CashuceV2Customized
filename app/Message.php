<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];

    public function receiver()
    {
        return $this->belongsTo(Employee::class, 'receiver_id');
    }
    public function sender()
    {
        return $this->belongsTo(Employee::class, 'sender_id')->withoutGlobalScope(ParentScope::class);
    }
}
