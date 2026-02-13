<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Conversation extends Model
{
    /** @use HasFactory<\Database\Factories\MessageFactory> */
    use HasFactory;

    protected $fillable = ['id', 'user_one', 'user_two'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one');
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two');
    }


    public static function getConversation($userA, $userB)
    {
        $ids = collect([$userA, $userB])->sort()->values();
        
        $conversation = Conversation::with(['messages', 'userOne', 'userTwo'])
            ->where('user_one', $ids[0])
            ->where('user_two', $ids[1])
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one' => $ids[0],
                'user_two' => $ids[1],
            ]);
            
            $conversation->setRelation('messages', collect());
            $conversation->load(['userOne', 'userTwo']);
        }

        return $conversation;
    }
}
