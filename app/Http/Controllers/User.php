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

        $query = ModelsUser::selectRaw("*, CONCAT(first_name, ' ', last_name) AS full_name");

        foreach($words as $word){
            $query->whereRaw("LOWER(CONCAT(first_name, ' ', last_name)) LIKE LOWER(?)", ["%$word%"])
                  ->where('id', '!=', Auth::id());
        }

        return $query->get();
    }
}
