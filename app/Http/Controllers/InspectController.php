<?php

namespace App\Http\Controllers;

use App\Models\Ex_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InspectController extends Controller
{
    public function view(Request $request): View
    {
        $ex_user = Ex_user::getData($request->ex_userId )->findOrFail($request->ex_userId);
        
        return view('inspect', [
            'user' => $request->user(),
            'ex_user' => $ex_user,
        ]);
    }
}
