<?php

namespace App\Http\Controllers;

use App\Models\Friendship as ModelsFriendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Friendship extends Controller
{
    public function view()
    {
        $friends = ModelsFriendship::FriendsWithFriendsCount(Auth::id())->paginate(12);
        $friends_count = ModelsFriendship::CountFriends(Auth::id());
        
        return view('friends',
            [
                'friends' => $friends,
                'friends_count' => $friends_count,
            ]);
    }
}
