<?php

namespace App;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $casts = [
        'created_at'  => 'date:D M d Y',
    ];
    public static function booted()
    {
        static::addGlobalScope(new ParentScope());

        static::creating(static function ($model){
            $model->company_id = Company::companyID();
        });

    }
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function hr()
    {
        return $this->belongsTo(Employee::class, 'hr_id')->withoutGlobalScope(ParentScope::class);
    }

    public function newMessage($senderId, $receiverId, $content)
    {
        Message::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'conversation_id' => $this->id,
            'content' => $content,
        ]);
    }
}
