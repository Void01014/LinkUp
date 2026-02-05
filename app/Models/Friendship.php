<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Friendship extends Model
{
    /** @use HasFactory<\Database\Factories\FriendshipFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
    ];

    public function scopeFriendsWithFriendsCount($query, $user_id = null)
    {
        $query->from('users');

        if ($user_id) {
            $query->where('users.id', '!=', $user_id);
        }

        if ($user_id) {
            $query->addSelect(['status' => function ($subquery) use ($user_id) {
                $subquery->select('status')
                    ->from('friendships')
                    ->where(function ($and) use ($user_id) {
                        $and->where('user_id', $user_id)
                            ->whereColumn('friend_id', 'users.id');
                    })
                    ->orWhere(function ($and) use ($user_id) {
                        $and->whereColumn('user_id', 'users.id')
                            ->where('friend_id', $user_id);
                    })
                    ->limit(1);
            }]);
        }

        if ($user_id) {
            $query->whereIn('users.id', function ($subquery) use ($user_id) {
                $subquery->select('friend_id')->from('friendships')->where('user_id', $user_id)
                    ->union($subquery->newQuery()->select('user_id')->from('friendships')->where('friend_id', $user_id));
            });
        }

        $query->addSelect(['friends_count' => function ($subquery) {
            $subquery->selectRaw('count(*)')
                ->from('friendships')
                ->where('status', 'accepted')
                ->where(function ($or) {
                    $or->whereColumn('user_id', 'users.id')
                        ->orWhereColumn('friend_id', 'users.id');
                });
        }]);

        return $query;
    }

    public static function countFriends($user_id)
    {
        return DB::table('friendships')
                    ->where('status', 'accepted')
                    ->where(function ($q)use ($user_id) {
                        $q->where('user_id', $user_id)
                        ->orWhere('friend_id', $user_id);
                    })->count();
    }
}
