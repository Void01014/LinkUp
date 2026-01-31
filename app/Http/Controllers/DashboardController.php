<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function create(Request $request){
        $user = User::find(Auth::user()->id);
        $users = User::withFriendsCount(Auth::id())->get();
        
        return view('dashboard', ['user' => $user, 'users' => $users]);
    }
}
