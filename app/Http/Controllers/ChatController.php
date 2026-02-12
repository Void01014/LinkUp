<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function inbox($id = null)
    {
        $conversations = User::where('status');
        $activeConversation = User::find($id) ?? [];
        $messages = Message::where(function ($query) use ($id) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', auth()->id());
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.inbox', [
            'conversations' => $conversations,
            'activeConversation' => $activeConversation,
            'messages' => $messages,
            'user_id' => auth()->user()->id,
        ]);
    }
}
