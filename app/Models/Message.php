<?php

namespace App\Models;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    public function Conversations()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
