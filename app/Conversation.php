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
        static::creating(static function ($model){
            $employee = auth()->user();
            $manager_id = ($employee->is_manager)? $employee->id:$employee->manager->id;
            $model->manager_id = $manager_id; // Ceo Id
        });
        static::addGlobalScope(new ParentScope());
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
