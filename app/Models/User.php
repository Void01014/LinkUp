<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scopeWithFriendsCount(Builder $query, $user_id = null)
    {
        //exclude the current user
        if ($user_id) {
            $query->where('users.id', '!=', $user_id);
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

        if ($user_id) {
            $query->addSelect(['status' => function ($subquery) use ($user_id){
                $subquery->select('status')
                    ->from('friendships')
                    ->where(function ($and) use ($user_id) {
                        $and->where('user_id', $user_id)->whereColumn('friend_id', 'users.id');
                    })
                    ->orWhere(function ($and) use ($user_id){
                        $and->whereColumn('user_id', 'users.id')->where('friend_id', 1);
                    })
                    ->limit(1);
            }]);
        }

        return $query;
    }
}
