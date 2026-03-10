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
    // If the provider is Google, force the account picker
    if ($provider === 'google') {
        return Socialite::driver($provider)
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    return Socialite::driver($provider)->redirect();
}

    public function callback($provider)
    {

        try {

            $socialUser = Socialite::driver($provider)->user();

            $user = User::where('social_id', $socialUser->id)->where('social_type', $provider)->first();

            if (!$user) {

                $user = User::where('email', $socialUser->getEmail())->first();

                if (isset($user)) {

                    $user->update([
                        'social_id' => $socialUser->getId(),
                        'social_type' => $provider,
                    ]);

                } else {


                    $name = explode(' ', $socialUser->getName());

                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'first_name' => $name[0],
                        'last_name' => $name[1],
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
            dd($e->getMessage());
            return redirect('/login')->with('error', 'Something went wrong during ' . $provider . ' login.');
        }
    }
}
