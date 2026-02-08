<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ex_user extends Model
{
    public static function getData()
    {
        return User::with(['posts' => function ($query) {
            $query->latest()
                ->withCount(['likes', 'comments'])
                ->withExists(['likes as i_liked' => function ($q) {
                    $q->where('user_id', Auth::id());
                }]);
        }]);
    }
}
