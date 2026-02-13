<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function inbox($id = null)
    {
        $conversations = User::all();
        $activeConversation = Conversation::getConversation(Auth::id(), $id);

        return view('chat.inbox', [
            'conversations' => $conversations,
            'activeConversation' => $activeConversation,
            'messages' => $activeConversation->messages,
            'user_id' => auth()->user()->id,
        ]);
    }
}
