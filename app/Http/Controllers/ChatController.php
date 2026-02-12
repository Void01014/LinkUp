<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function inbox(){
        $conversations = [];
        $activeConversation = [];

        return view('chat.inbox', [
            'conversations' => $conversations,
            'activeConversation' => $activeConversation,
        ]);
    }
}
