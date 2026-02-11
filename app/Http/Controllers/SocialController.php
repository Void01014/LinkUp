<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function callback($provider)
    {

        try {

            $socialUser = Socialite::driver($provider)->user();

            $user = User::where('social_id', $socialUser->id)->where('social_type', $provider)->first();

            if (!$user) {

                $user = User::where('email', $socialUser->getEmail())->first();

                if ($user) {

                    $user->update([
                        'social_id' => $socialUser->getId(),
                        'social_type' => $provider,
                    ]);

                } else {
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'social_id' => $socialUser->getId(),
                        'social_type' => $provider,
                        'password' => null,
                    ]);

                }

            }

            Auth::login($user);



            return redirect()->intended('/profile');

        } catch (Exception $e) {

            return redirect('/login')->with('error', 'Something went wrong during ' . $provider . ' login.');
        }
    }
}
