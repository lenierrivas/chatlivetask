<?php

namespace App\Models;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    public function room() {
        return $this->hasOne( ChatRoom::class, 'id', 'room_id' );
    }

    public function user() {
        return $this->hasOne( User::class, 'id', 'user_id' );
    }
}
