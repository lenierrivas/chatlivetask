<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatLiveController extends Controller
{
    public function Rooms(){
        return ChatRoom::all();
    }

    public function Messages( Request $request, $roomId ){
        return ChatMessage::where('room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public function NewMessages( Request $request, $roomId ){
        $newMessage = new ChatMessage;
        $newMessage->room_id = $roomId;
        $newMessage->user_id = Auth::id();
        $newMessage->message = $request['message'];
        $newMessage->save();

        broadcast( new NewChatMessage( $newMessage ))->toOthers();

        return $newMessage;
    }

    public function user(){
        return User::find(Auth::id());
    }


}
