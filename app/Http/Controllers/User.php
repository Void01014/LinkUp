<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Mod;
use Symfony\Component\Console\Input\Input;

class User extends Controller
{
    public function search(Request $request)
    {

        $words = explode(' ', $_GET['username']);
        
        $query = ModelsUser::withFriendsCount(Auth::id(), $words)->get();

        return $query;
    }
}
