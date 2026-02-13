<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{id}', function ($user, $id) {
    $conversation = Conversation::getConversation($user->id, $id);
    return $conversation && ($user->id === $conversation->user_one || $user->id === $conversation->user_two);
});