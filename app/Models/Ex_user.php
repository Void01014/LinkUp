<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ex_user extends Model
{
    public static function getData($user_id)
    {
        $query = User::with(['posts' => function ($stats) {
            $stats->latest()
                ->withCount(['likes', 'comments'])
                ->withExists(['likes as i_liked' => function ($q) {
                    $q->where('user_id', Auth::id());
                }]);
        }, 'posts.comments.user' => function ($comments){
            $comments->select('id', 'first_name', 'last_name');
        }]);

        $query->addSelect(['status' => function ($subquery) use ($user_id) {
            $subquery->select('status')
                ->from('friendships')
                ->where(function ($and) use ($user_id) {
                    $and->where('user_id', $user_id)->where('friend_id', Auth::id());
                })
                ->orWhere(function ($and) use ($user_id) {
                    $and->where('user_id', Auth::id())->where('friend_id', $user_id);
                })
                ->limit(1);
        }]);

        return $query;
    }
}
