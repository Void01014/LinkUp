<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function inbox($id = null)
    {
        if ($id) {

            $activeConversation = Conversation::getConversation(Auth::id(), $id);
        }
        $myId = Auth::id();
        $conversations = User::whereIn('id', function ($query) use ($myId) {
            $query->select('friend_id')
                ->from('friendships')
                ->where('user_id', $myId)
                ->union(
                    DB::table('friendships')
                        ->select('user_id')
                        ->where('friend_id', $myId)
                );
        })->get();

        return view('chat.inbox', [
            'conversations' => $conversations ?? [],
            'activeConversation' => $activeConversation ?? [],
            'messages' => $activeConversation->messages ?? [],
            'user_id' => Auth::id(),
        ]);
    }
}
