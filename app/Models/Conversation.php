<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    public function userone()
    {
        return $this->belongsTo(User::class, 'user_one', 'id');
    }

    public function usertwo()
    {
        return $this->belongsTo(User::class, 'user_two', 'id');
    }
}
