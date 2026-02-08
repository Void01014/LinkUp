<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }


    public function commentedposts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'comments');
    }

    public function likedposts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes');
    }



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
        'bio',
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

    public function scopeWithFriendsCount(Builder $query, $user_id = null, $words)
    {
        $query->selectRaw("*, CONCAT(first_name, ' ', last_name) AS full_name")->limit(8);

        if ($user_id) {
            $query->where('users.id', '!=', $user_id);
        }


        foreach ($words as $word) {
            $query->whereRaw("LOWER(CONCAT(first_name, ' ', last_name)) LIKE LOWER(?)", ["%$word%"]);
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
            $query->addSelect(['status' => function ($subquery) use ($user_id) {
                $subquery->select('status')
                    ->from('friendships')
                    ->where(function ($and) use ($user_id) {
                        $and->where('user_id', $user_id)->whereColumn('friend_id', 'users.id');
                    })
                    ->orWhere(function ($and) use ($user_id) {
                        $and->whereColumn('user_id', 'users.id')->where('friend_id', $user_id);
                    })
                    ->limit(1);
            }]);
        }

        return $query;
    }
}
