<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;

class SocialAuthTwitterController extends Controller
{
    //
    public function redirect() {
        return Socialite::driver('twitter')->redirect();
    }

    public function callback()
    {
        try {
            $provider = Socialite::driver('twitter')->user();
            $user = User::where('original_id', $provider->getId())
                ->where('channel', 'twitter')->first();
            if ($user) {
                Auth::login($user, true);
            } else {
                User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => md5(rand(1, 10000)),
                    'original_id' => $provider->getId(),
                    'access_token' => $provider->token,
                    'access_token_secret' => $provider->tokenSecret,
                    'channel' => "twitter"
                ]);

                $newUser = User::where('original_id', $provider->getId())
                    ->where('channel', 'twitter')->first();
                Auth::login($newUser, true);
            }
            return redirect('/home');
        } catch (\Exception $exception) {
            return redirect('/');
        }
    }
}
