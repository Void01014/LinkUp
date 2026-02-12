<?php

namespace App\Http\Controllers;

use App\Models\QrScan;

use App\Models\Friendship;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Carbon\Carbon;

class QrScanController extends Controller

{

    public function generate()

    {

        $token = (string) Str::uuid();

        $qrCode = QrScan::create([

            'user_id' => Auth::id(),

            'token' => $token,

            'hits' => 0,

            'expires_at' => Carbon::now()->addHour(),

        ]);

        $url = route('qr.scan', ['token' => $token]);

        $svg = QrCode::format('svg')->size(300)->generate($url);

        return response($svg)->header('Content-Type', 'image/svg+xml');

    }


    public function generateLink()

    {

        $token = (string) Str::uuid();

        QrScan::create([

            'user_id' => Auth::id(),

            'token' => $token,

            'hits' => 0,

            'expires_at' => Carbon::now()->addHour(),

        ]);

        $url = route('qr.scan', ['token' => $token]);

        return response()->json([

            'success' => true,

            'url' => $url,

            'expires_in' => '1 hour',

        ]);

    }

    public function scan(string $token)

    {


        $qrCode = QrScan::where('token', $token)->firstOrFail();

        if ($qrCode->isExpired()) {

            return view('qr.expired', [

                'message' => 'This QR code/link has expired.'

            ]);

        }

        $qrCode->increment('hits');

        $qrOwner = $qrCode->user;

        if (!Auth::check()) {

            session(['intended_url' => route('qr.scan', ['token' => $token])]);

            return redirect()->route('login')

                ->with('message', 'Please login to add this friend.');

        }

        $currentUser = Auth::user();

        if ($currentUser->id === $qrOwner->id) {

            return redirect()->route('profile')

                ->with('error', 'You cannot add yourself as a friend.');

        }

        $existingFriendship = Friendship::where(function ($query) use ($currentUser, $qrOwner) {

            $query->where('user_id', $currentUser->id)

                  ->where('friend_id', $qrOwner->id);

        })->orWhere(function ($query) use ($currentUser, $qrOwner) {

            $query->where('user_id', $qrOwner->id)

                  ->where('friend_id', $currentUser->id);

        })->first();

        if ($existingFriendship) {

            if ($existingFriendship->status === 'accepted') {

                return redirect()->route('inspect.view', ['ex_userId' => $qrOwner->id])

                    ->with('info', 'You are already friends with ' . $qrOwner->first_name);

            }

            $existingFriendship->status = 'accepted';

            $existingFriendship->save();

            return redirect()->route('inspect.view', ['ex_userId' => $qrOwner->id])

                ->with('success', 'You are now friends with ' . $qrOwner->first_name);

        }

        Friendship::create([

            'user_id' => $currentUser->id,

            'friend_id' => $qrOwner->id,

            'status' => 'accepted',

        ]);

        return redirect()->route('inspect.view', ['ex_userId' => $qrOwner->id])

            ->with('success', 'You are now friends with ' . $qrOwner->first_name . '!');

    }

}